<?php
require_once 'db_connection.php';

// Fetch all queries
$stmt = $pdo->query("SELECT * FROM contact_queries ORDER BY created_at DESC");
$queries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Contact Queries</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        oct: { yellow: '#FFE073', dark: '#252525' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans text-oct-dark">

    <!-- Navbar -->
    <nav class="bg-oct-dark text-white p-6 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-oct-yellow rounded text-oct-dark flex items-center justify-center font-bold">O</div>
                <span class="text-xl font-bold">Octalgo Admin</span>
            </div>
            <div class="text-sm text-gray-400">Logged in as Admin</div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-6 mt-8">
        <h1 class="text-3xl font-bold mb-8">Client Inquiries</h1>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                            <th class="p-4 font-bold border-b">ID</th>
                            <th class="p-4 font-bold border-b">Date</th>
                            <th class="p-4 font-bold border-b">Client</th>
                            <th class="p-4 font-bold border-b">Services Needed</th>
                            <th class="p-4 font-bold border-b">Message</th>
                            <th class="p-4 font-bold border-b text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if (count($queries) > 0): ?>
                            <?php foreach ($queries as $row): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-gray-400 text-sm">#<?php echo htmlspecialchars($row['id']); ?></td>
                                <td class="p-4 text-sm whitespace-nowrap">
                                    <?php echo date('M d, Y', strtotime($row['created_at'])); ?><br>
                                    <span class="text-xs text-gray-400"><?php echo date('H:i', strtotime($row['created_at'])); ?></span>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold"><?php echo htmlspecialchars($row['name']); ?></div>
                                    <div class="text-sm text-gray-500"><?php echo htmlspecialchars($row['email']); ?></div>
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-2">
                                        <?php 
                                            $services = explode(',', $row['services']);
                                            foreach($services as $service): 
                                                if(trim($service) == '') continue;
                                        ?>
                                            <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-xs font-semibold border border-blue-100">
                                                <?php echo htmlspecialchars(trim($service)); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-gray-600 max-w-xs truncate" title="<?php echo htmlspecialchars($row['message']); ?>">
                                    <?php echo htmlspecialchars($row['message']); ?>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">New</span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-400">No queries found yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>