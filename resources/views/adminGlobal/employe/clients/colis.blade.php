<th class="py-2 px-3 text-left">ID</th>
                <th class="py-2 px-3 text-left">Code Suivi</th>
                <th class="py-2 px-3 text-left">Prix</th>
                <th class="py-2 px-3 text-left">Statut</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($colis as $c)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $c->id }}</td>
                    <td class="py-2 px-3">{{ $c->code_suivi }}</td>
                    <td class="py-2 px-3">{{ number_format($c->prix, 2) }} DA</td>
                    <td class="py-2 px-3">{{ ucfirst($c->statut) }}</td>
                    <td class="py-2 px-3 flex space-x-3">
                        <a href="{{ route('admin.global.colis.show', $c) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('admin.global.colis.edit', $c) }}" class="text-yellow-600 hover:underline">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-2 px-3 text-center">Aucun colis trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>