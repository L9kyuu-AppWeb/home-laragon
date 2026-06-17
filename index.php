<?php
$url = "https://assuring-quail-real.ngrok-free.app"; // Ganti dengan URL Ngrok yang valid

// Fungsi untuk mendapatkan IP asli pengguna
function getRealUserIP() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $ips = explode(',', $ip);
        return trim($ips[0]);
    }
    if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    }
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    return $_SERVER['REMOTE_ADDR'];
}

$user_ip = getRealUserIP();
$allowed_ips = ['127.0.0.1', '::1', 'localhost'];
$is_local_ip = false;
if (filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
    $is_local_ip = true;
}

if (!$is_local_ip && !in_array($user_ip, $allowed_ips)) {
    header('Location: restricted.php');
    exit;
}

if (isset($_GET['debug']) && ($is_local_ip || in_array($user_ip, $allowed_ips))) {
    echo "";
}

// Handle Request Buka VS Code via AJAX
if (isset($_POST['open_code'])) {
    header('Content-Type: application/json');
    $folder_path = $_POST['open_code'];

    if (is_dir($folder_path)) {
        $command = 'code "' . str_replace('/', '\\', $folder_path) . '"';
        pclose(popen("start /B " . $command, "r"));
        echo json_encode(['success' => true, 'message' => 'VS Code berhasil dibuka']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Direktori tidak ditemukan']);
    }
    exit;
}

// Handle Share Project via Ngrok
if (isset($_POST['share_project'])) {
    header('Content-Type: application/json');
    $project = trim($_POST['share_project'] ?? '');
    $ngrokUrl = trim($_POST['ngrok_url'] ?? '');

    if (empty($project) || empty($ngrokUrl)) {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
        exit;
    }

    $parsed = parse_url($ngrokUrl);
    if (!isset($parsed['host'])) {
        echo json_encode(['success' => false, 'message' => 'URL Ngrok tidak valid']);
        exit;
    }

    $ngrokHost = $parsed['host'];
    $port = ($parsed['scheme'] ?? 'https') === 'https' ? 443 : 80;
    $projectHost = $project . '.test';

    $command = 'start cmd /k "ngrok http ' . $port . ' --host-header=' . $projectHost . ' --url ' . $ngrokHost . '"';
    pclose(popen($command, "r"));

    echo json_encode(['success' => true, 'command' => $command]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laragon Hub &mdash; Local Development Console</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0e1117;
            --surface: #161a22;
            --surface-soft: #1c212b;
            --line: #2a3140;
            --text: #e8ebf1;
            --muted: #828ca0;
            --faint: #4d5566;
            --amber: #f4a623;
            --cyan: #3ad8c4;
            --danger: #f0556b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--ink);
            background-image: radial-gradient(rgba(255,255,255,0.045) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #2a3140; border-radius: 20px; }
        ::-webkit-scrollbar-thumb:hover { background: #3a4358; }
    </style>
</head>

<?php
if (isset($_GET['phpinfo']) && $_GET['phpinfo'] == '1') {
    ob_start();
    phpinfo();
    $phpinfo = ob_get_clean();
    preg_match('/<body>(.*?)<\/body>/s', $phpinfo, $matches);
    if (isset($matches[1])) {
        echo '<style>
            .phpinfo { font-family: "JetBrains Mono", monospace; font-size: 0.82rem; }
            .phpinfo table { width: 100%; border-collapse: collapse; margin: 14px 0; }
            .phpinfo th, .phpinfo td { padding: 9px 12px; text-align: left; border: 1px solid #e7e2d6; }
            .phpinfo th { background: #f1ede2; font-weight: 600; color: #2b2317; }
            .phpinfo tr:nth-child(even) { background: #f6f3ea; }
            .phpinfo h2 { color: #2b2317; font-size: 1.1rem; font-weight: 700; margin: 22px 0 10px 0; border-bottom: 2px solid #f4a623; padding-bottom: 6px; font-family: "Space Grotesk", sans-serif; }
            .phpinfo .center { text-align: center; }
        </style>';
        echo '<div class="phpinfo text-[#3a3326]">' . $matches[1] . '</div>';
    }
    exit;
}
?>

<body class="min-h-screen text-[var(--text)] antialiased selection:bg-[var(--amber)] selection:text-black">

    <header class="border-b border-[var(--line)] bg-[var(--ink)]/95 backdrop-blur sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg border border-[var(--line)] bg-[var(--surface)] flex items-center justify-center text-[var(--amber)]">
                    <i class="fas fa-circle-nodes"></i>
                </div>
                <div>
                    <h1 class="font-display text-lg font-bold text-[var(--text)] tracking-tight leading-none">Laragon Hub</h1>
                    <p class="text-[11px] text-[var(--muted)] mt-0.5">Local development console</p>
                </div>
            </div>

            <div class="flex items-center divide-x divide-[var(--line)] border border-[var(--line)] rounded-lg overflow-hidden text-[11px]">
                <span class="flex items-center gap-1.5 px-3 py-1.5 text-[var(--muted)]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--cyan)] animate-pulse"></span> Local environment
                </span>
                <span class="px-3 py-1.5 text-[var(--muted)]">
                    <span class="font-mono text-[var(--text)]"><?php echo explode('/', $_SERVER['SERVER_SOFTWARE'] ?? 'unknown')[0]; ?></span>
                </span>
                <span class="px-3 py-1.5 text-[var(--muted)]">
                    PHP <span class="font-mono text-[var(--text)]"><?php echo phpversion(); ?></span>
                </span>
                <button onclick="showPhpInfo()" class="px-3 py-1.5 text-[var(--amber)] font-semibold hover:bg-[var(--surface-soft)] transition-colors cursor-pointer">
                    PHP Info
                </button>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="rounded-xl border border-[var(--line)] bg-[var(--surface)] flex flex-col md:flex-row divide-y md:divide-y-0 md:divide-x divide-[var(--line)] overflow-hidden mb-2">
            <div class="flex-1 flex items-center gap-3 px-5 py-4">
                <span class="font-mono text-[var(--cyan)] text-sm">&gt;_</span>
                <input type="text" id="searchInput" placeholder="filter projects..."
                       class="flex-1 bg-transparent outline-none font-mono text-sm text-[var(--text)] placeholder:text-[var(--faint)]">
            </div>
            <div class="flex-1 flex items-center gap-3 px-5 py-4">
                <i class="fas fa-plug text-[var(--amber)] text-sm"></i>
                <input type="text" id="ngrokUrl" placeholder="https://xxxx-xx-xxx.ngrok-free.app"
                       value="<?php echo htmlspecialchars($url); ?>"
                       class="flex-1 bg-transparent outline-none font-mono text-sm text-[var(--text)] placeholder:text-[var(--faint)]">
            </div>
        </div>
        <p class="text-[11px] text-[var(--faint)] px-1 mb-10">Tunnel target ini dipakai oleh tombol share di setiap kartu project.</p>

        <div class="flex items-center justify-between border-b border-[var(--line)] pb-4 mb-6">
            <h2 class="font-display text-base font-bold text-[var(--text)]">Workspace projects</h2>
            <?php
            $directory = 'C:\laragon\www';
            $project_dirs = [];
            if (is_dir($directory)) {
                foreach (array_diff(scandir($directory), ['.', '..']) as $item) {
                    if (is_dir($directory . DIRECTORY_SEPARATOR . $item)) {
                        $project_dirs[] = $item;
                    }
                }
            }
            $project_count = count($project_dirs);
            ?>
            <span class="font-mono text-[11px] text-[var(--muted)] border border-[var(--line)] rounded-md px-2 py-1">
                <?php echo $project_count; ?> mounted
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4" id="projectsContainer">
            <?php
            if (!is_dir($directory)): ?>
                <div class="col-span-full bg-[#2a1418] border border-[var(--danger)]/30 rounded-xl p-6 text-center">
                    <i class="fas fa-triangle-exclamation text-[var(--danger)] text-3xl mb-2"></i>
                    <p class="text-[#f5b8c2] text-sm font-bold">Direktori tidak ditemukan</p>
                    <p class="text-[var(--danger)] text-xs mt-0.5">Pastikan jalur ini valid: <span class="font-mono bg-black/20 px-1 rounded"><?php echo htmlspecialchars($directory); ?></span></p>
                </div>
            <?php elseif (empty($project_dirs)): ?>
                <div class="col-span-full text-center py-16 bg-[var(--surface)] border border-[var(--line)] border-dashed rounded-xl">
                    <i class="fas fa-folder-open text-[var(--line)] text-5xl mb-3"></i>
                    <p class="text-[var(--muted)] font-medium text-sm">Belum ada folder proyek terdeteksi di www.</p>
                </div>
            <?php else:
                $scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
                $host     = $_SERVER['HTTP_HOST'];
                $base_url = $scheme . '://' . $host;

                foreach ($project_dirs as $project):
                    $project_url      = $base_url . '/' . $project;
                    $project_test_url = $scheme . '://' . $project . '.test';
                    $project_path     = $directory . DIRECTORY_SEPARATOR . $project;
                    $clean_name       = str_replace('-', ' ', $project);
            ?>
                <div class="project-card group bg-[var(--surface)] border border-[var(--line)] rounded-xl overflow-hidden hover:border-[var(--amber)]/50 transition-colors flex flex-col" data-project-name="<?php echo strtolower($project); ?>">
                    <div class="p-5 flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full bg-[var(--cyan)] shadow-[0_0_8px_rgba(58,216,196,0.6)]"></span>
                            <span class="text-[10px] text-[var(--faint)] uppercase tracking-wider">auto vhost</span>
                        </div>
                        <h3 class="font-mono text-[15px] font-semibold text-[var(--text)] truncate"><?php echo htmlspecialchars($project . '.test'); ?></h3>
                        <p class="text-xs text-[var(--muted)] mt-1 truncate flex items-center gap-1.5 capitalize">
                            <i class="far fa-folder text-[var(--faint)]"></i> <?php echo htmlspecialchars($clean_name); ?>
                        </p>
                        <p class="text-[10px] font-mono text-[var(--faint)] truncate mt-2" title="<?php echo htmlspecialchars($project_path); ?>"><?php echo htmlspecialchars($project_path); ?></p>
                    </div>

                    <div class="grid grid-cols-5 gap-1.5 px-4 py-3 border-t border-[var(--line)] bg-[var(--surface-soft)]">
                        <a href="<?php echo $project_url; ?>" target="_blank" title="Buka via Localhost"
                           class="flex items-center justify-center h-8 rounded-md border border-[var(--line)] text-[var(--muted)] hover:text-[var(--cyan)] hover:border-[var(--cyan)]/40 transition-colors text-xs">
                            <i class="fas fa-arrow-up-right-from-square"></i>
                        </a>
                        <a href="<?php echo $project_test_url; ?>" target="_blank" title="Buka via Virtual Host (.test)"
                           class="flex items-center justify-center h-8 rounded-md border border-[var(--line)] text-[var(--muted)] hover:text-[var(--amber)] hover:border-[var(--amber)]/40 transition-colors text-xs">
                            <i class="fas fa-globe"></i>
                        </a>
                        <button onclick="openInVSCode('<?php echo addslashes($project_path); ?>', '<?php echo addslashes($clean_name); ?>')" title="Buka di VS Code"
                                class="flex items-center justify-center h-8 rounded-md border border-[var(--line)] text-[var(--muted)] hover:text-[#3b9ee5] hover:border-[#3b9ee5]/40 transition-colors text-xs cursor-pointer">
                            <i class="fab fa-microsoft"></i>
                        </button>
                        <button onclick="copyUrl('<?php echo addslashes($project_url); ?>')" title="Salin URL"
                                class="flex items-center justify-center h-8 rounded-md border border-[var(--line)] text-[var(--muted)] hover:text-[var(--text)] hover:border-[var(--faint)] transition-colors text-xs cursor-pointer">
                            <i class="far fa-copy"></i>
                        </button>
                        <button onclick="shareProject('<?php echo addslashes($project); ?>')" title="Share via Ngrok"
                                class="flex items-center justify-center h-8 rounded-md bg-[var(--amber)] text-[#241a06] font-semibold hover:bg-[#ffb43d] transition-colors text-xs cursor-pointer">
                            <i class="fas fa-share-nodes"></i>
                        </button>
                    </div>
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>

    <div id="phpInfoModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-[var(--surface)] rounded-xl shadow-2xl max-w-4xl w-full max-h-[85vh] overflow-hidden flex flex-col border border-[var(--line)]">
            <div class="px-6 py-4 border-b border-[var(--line)] flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fab fa-php text-[var(--amber)] text-lg"></i>
                    <h2 class="font-display text-sm font-bold text-[var(--text)]">PHP runtime details</h2>
                </div>
                <button onclick="closePhpInfo()" class="text-[var(--muted)] hover:text-[var(--text)] hover:bg-[var(--surface-soft)] rounded-md p-1.5 transition-colors cursor-pointer">
                    <i class="fas fa-xmark text-lg"></i>
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-6 bg-[#faf8f3]" id="phpInfoContent">
                <div class="text-center py-12">
                    <i class="fas fa-circle-notch fa-spin text-[var(--amber)] text-2xl mb-2"></i>
                    <p class="text-[var(--muted)] text-xs font-mono">reading runtime configuration...</p>
                </div>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

    <script>
        function showPhpInfo() {
            const modal = document.getElementById('phpInfoModal');
            modal.classList.remove('hidden');
            fetch('?phpinfo=1')
                .then(response => response.text())
                .then(data => { document.getElementById('phpInfoContent').innerHTML = data; })
                .catch(() => {
                    document.getElementById('phpInfoContent').innerHTML =
                        '<div class="text-center text-red-500 py-6"><i class="fas fa-triangle-exclamation text-2xl mb-2"></i><p class="text-sm font-semibold">Gagal memuat PHP Info</p></div>';
                });
        }

        function closePhpInfo() {
            document.getElementById('phpInfoModal').classList.add('hidden');
        }

        document.getElementById('phpInfoModal').addEventListener('click', function(e) {
            if (e.target === this) closePhpInfo();
        });

        const searchInput = document.getElementById('searchInput');
        const projectCards = document.querySelectorAll('.project-card');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            projectCards.forEach(card => {
                const name = card.getAttribute('data-project-name');
                card.style.display = name.includes(searchTerm) ? 'flex' : 'none';
            });
        });

        function openInVSCode(path, cleanName) {
            const formData = new FormData();
            formData.append('open_code', path);

            fetch('', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('VS Code dibuka untuk proyek: ' + cleanName, 'success');
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(() => showToast('Gagal memproses request ke server', 'error'));
        }

        function copyUrl(url) {
            navigator.clipboard.writeText(url).then(() => {
                showToast('URL berhasil disalin ke clipboard!', 'success');
            }).catch(() => {
                showToast('Gagal menyalin URL', 'error');
            });
        }

        function shareProject(projectName) {
            const ngrokUrl = document.getElementById('ngrokUrl').value.trim();
            if (!ngrokUrl) {
                showToast('Masukkan URL Ngrok terlebih dahulu!', 'error');
                return;
            }

            const formData = new FormData();
            formData.append('share_project', projectName);
            formData.append('ngrok_url', ngrokUrl);

            fetch('', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast('Ngrok terminal berhasil dibuka untuk ' + projectName, 'success');
                    console.log(data.command);
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(err => showToast(err.message, 'error'));
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `flex items-start gap-3 pl-3 pr-4 py-3 rounded-lg shadow-lg border-l-[3px] bg-[var(--surface)] border border-[var(--line)] text-xs font-medium text-[var(--text)] pointer-events-auto min-w-[260px] transition-all duration-300 transform translate-y-2 opacity-0 ${
                type === 'success' ? 'border-l-[var(--cyan)]' : 'border-l-[var(--danger)]'
            }`;

            const icon = type === 'success'
                ? '<i class="fas fa-circle-check text-[var(--cyan)] text-sm mt-0.5"></i>'
                : '<i class="fas fa-circle-exclamation text-[var(--danger)] text-sm mt-0.5"></i>';
            toast.innerHTML = `${icon} <span class="flex-1">${message}</span>`;

            container.appendChild(toast);
            setTimeout(() => toast.classList.remove('translate-y-2', 'opacity-0'), 50);
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }
    </script>
</body>
</html>