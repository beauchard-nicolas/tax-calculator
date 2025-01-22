<!-- Composant d'affichage des résultats -->
     @if(isset($result))
     <div id="results" class="bg-white rounded-lg shadow-lg p-8 max-w-4xl mx-auto mb-8 relative">    
    <!-- Indicateur de tranche d'imposition -->
    @if(isset($result['tax_band']))
        <div class="absolute top-4 right-4">
            <div class="w-6 h-6 rounded-full flex items-center justify-center text-white font-semibold text-lg font-baloo" 
                 style="background-color: {{ $result['tax_band']->color }}">
                {{ substr($result['tax_band']->name, -1) }}
            </div>
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Section des résultats annuels -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Annual Breakdown</h2>
            
            <div class="bg-cyan-50 p-4 rounded-lg">
                <div>
                    <p class="text-gray-600">Gross Annual Salary</p>
                    <p class="text-2xl font-bold text-cyan-800">£{{ number_format($result['gross_annual'], 2) }}</p>
                </div>
            </div>

            <div class="bg-cyan-50 p-4 rounded-lg">
                <div>
                    <p class="text-gray-600">Net Annual Salary</p>
                    <p class="text-2xl font-bold text-cyan-800">£{{ number_format($result['net_annual'], 2) }}</p>
                </div>
            </div>

            <div class="bg-cyan-50 p-4 rounded-lg">
                <div>
                    <p class="text-gray-600">Annual Tax Paid</p>
                    <p class="text-2xl font-bold text-cyan-800">£{{ number_format($result['tax_annual'], 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Section des résultats mensuels -->
        <div class="space-y-4">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Monthly Breakdown</h2>
            
            <div class="bg-blue-50 p-4 rounded-lg">
                <div>
                    <p class="text-gray-600">Gross Monthly Salary</p>
                    <p class="text-2xl font-bold text-blue-800">£{{ number_format($result['gross_monthly'], 2) }}</p>
                </div>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg">
                <div>
                    <p class="text-gray-600">Net Monthly Salary</p>
                    <p class="text-2xl font-bold text-blue-800">£{{ number_format($result['net_monthly'], 2) }}</p>
                </div>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg">
                <div>
                    <p class="text-gray-600">Monthly Tax Paid</p>
                    <p class="text-2xl font-bold text-blue-800">£{{ number_format($result['tax_monthly'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif