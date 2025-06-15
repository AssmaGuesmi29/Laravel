<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4361ee',
                        secondary: '#3f37c9',
                        dark: '#0f172a',
                        light: '#f8fafc'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-gradient-to-r from-primary to-secondary text-white shadow-lg">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Gestion des Utilisateurs</h1>
                        <p class="opacity-80 mt-1">Interface d'administration des comptes utilisateurs</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 rounded-full bg-white bg-opacity-20 placeholder-white focus:outline-none focus:ring-2 focus:ring-white">
                        </div>
                        <div class="w-10 h-10 rounded-full bg-white bg-opacity-30 flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Liste des Utilisateurs</h2>
                    <a href="{{ route('users.create') }}" class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg flex items-center action-btn">
                        <i class="fas fa-plus mr-2"></i> Nouvel Utilisateur
                    </a>
                </div>

                <!-- Users Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>Utilisateur</span>
                                        <i class="fas fa-sort ml-2 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dernière activité
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="user-card transition-all duration-300 hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary bg-opacity-20 flex items-center justify-center">
                                            <span class="text-primary font-semibold">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Actif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Il y a 2 heures
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:text-blue-900 action-btn" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:text-yellow-900 action-btn" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 action-btn" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Card Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-700 mb-4 md:mb-0">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">{{ count($users) }}</span> sur <span class="font-medium">{{ count($users) }}</span> utilisateurs
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 rounded-md bg-primary text-white">
                            1
                        </button>
                        <button class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300">
                            2
                        </button>
                        <button class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Utilisateurs Totaux</h3>
                            <p class="text-3xl font-bold text-primary mt-2">{{ count($users) }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-primary bg-opacity-10">
                            <i class="fas fa-users text-primary text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>12% de plus que le mois dernier</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Utilisateurs Actifs</h3>
                            <p class="text-3xl font-bold text-green-600 mt-2">{{ count($users) - 1 }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-green-600 bg-opacity-10">
                            <i class="fas fa-user-check text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clock mr-1"></i>
                            <span>1 inactif ce mois</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">Dernier Utilisateur</h3>
                            <p class="text-lg font-bold text-gray-900 mt-2">{{ $users->last()->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $users->last()->email ?? '' }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-600 bg-opacity-10">
                            <i class="fas fa-user-plus text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar mr-1"></i>
                            <span>Aujourd'hui, 10:24</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Floating Action Button -->
        <div class="fixed bottom-6 right-6">
            <button class="w-14 h-14 rounded-full bg-primary text-white shadow-lg flex items-center justify-center hover:bg-secondary transition-all duration-300">
                <i class="fas fa-plus text-xl"></i>
            </button>
        </div>

        <!-- Footer -->
        <footer class="bg-white border-t mt-8 py-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-600">
                    </div>
                    <div class="flex space-x-4 mt-4 md:mt-0">
                        <a href="#" class="text-gray-500 hover:text-primary">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-primary">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Scripts simples pour améliorer l'interactivité
        document.addEventListener('DOMContentLoaded', function() {
            // Animation pour les cartes
            const cards = document.querySelectorAll('.user-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.classList.add('shadow-lg');
                });

                card.addEventListener('mouseleave', () => {
                    card.classList.remove('shadow-lg');
                });
            });

            const deleteButtons = document.querySelectorAll('form button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>
