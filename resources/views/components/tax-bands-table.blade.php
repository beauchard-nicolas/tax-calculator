<!-- Composant d'affichage des tranches d'imposition -->
     <div class="bg-white rounded-lg shadow-lg p-8 max-w-4xl mx-auto mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4 font-poppins">Tax Bands</h2>
    <p class="text-gray-600 mb-4 font-inter">
        The UK tax system is based on tax bands. Each band has a specific tax rate that applies to the portion of your salary that falls within that band. 
        The goal of this small application is to simplify the calculation and provide better visibility regarding your tax and income calculations.
    </p>
    <div class="flex justify-center">
        <div class="overflow-x-auto max-w-2xl w-full">
            <table class="w-full border-separate border-spacing-0 rounded-lg border-2 border-cyan-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left bg-cyan-200 text-cyan-800 first:rounded-tl-lg">Tax Band</th>
                        <th class="px-4 py-3 text-left bg-cyan-200 text-cyan-800">Annual Salary Range (£)</th>
                        <th class="px-4 py-3 text-left bg-cyan-200 text-cyan-800 last:rounded-tr-lg">Tax Rate (%) * </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle d'affichage des tranches d'imposition -->
                    @foreach($taxBands as $band)
                        <tr class="hover:bg-cyan-50 transition-colors">
                            <td class="px-4 py-3 {{ $loop->first ? 'first:rounded-bl-lg' : '' }}">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full" style="background-color: {{ $band->color }}"></div>
                                    {{ $band->name }}
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($band->upper_limit)
                                    {{ number_format($band->lower_limit) }} - {{ number_format($band->upper_limit) }}
                                @else
                                    {{ number_format($band->lower_limit) }} +
                                @endif
                            </td>
                            <td class="px-4 py-3 {{ $loop->last ? 'last:rounded-br-lg' : '' }}">{{ $band->rate }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-right text-sm text-gray-500 mt-2">* Each band's rate applies only to income earned within that band</p>
        </div>
    </div>
</div>