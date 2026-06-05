<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord — Administration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Articles</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalArticles }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Catégories</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCategories }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Commentaires</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalComments }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Auteurs / Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg font-semibold text-gray-800">Articles récents (7 derniers insérés)</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100/70 border-b border-gray-200">
                                <th class="p-4 font-semibold text-sm text-gray-700">ID</th>
                                <th class="p-4 font-semibold text-sm text-gray-700">Titre</th>
                                <th class="p-4 font-semibold text-sm text-gray-700">Date de création</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentPosts as $article)
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td class="p-4 text-sm font-medium text-gray-600">{{ $article->id }}</td>
                                    <td class="p-4 text-sm font-semibold text-gray-900">{{ $article->title }}</td>
                                    <td class="p-4 text-sm text-gray-500">{{ $article->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-8 text-center text-sm text-gray-500">
                                        Aucun article n'a été publié pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>