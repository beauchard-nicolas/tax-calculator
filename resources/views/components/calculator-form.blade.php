<!-- Composant du formulaire de calcul -->
     <div class="bg-white rounded-lg shadow-lg p-8 max-w-4xl mx-auto mb-8">
    <div class="space-y-4">
        <label class="block text-gray-700 text-lg font-semibold">Gross Salary</label>
        <form action="{{ route('tax.calculate') }}#results" method="POST" class="flex gap-4">
            @csrf
            <div class="flex gap-4 flex-1">
                <!-- Menu déroulant de sélection de période -->
                <select name="period" 
                        class="w-40 py-3 px-4 rounded-lg border-2 border-cyan-200 focus:border-cyan-400 focus:ring focus:ring-cyan-200 focus:ring-opacity-50 transition-all text-lg bg-white"
                        id="salary-period">
                    <option value="annual" {{ (old('period', $request->period ?? '') == 'annual') ? 'selected' : '' }}>Annual</option>
                    <option value="monthly" {{ (old('period', $request->period ?? '') == 'monthly') ? 'selected' : '' }}>Monthly</option>
                </select>

                <!-- Champ de saisie du salaire -->
                <div class="relative flex-1">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-lg">£</span>
                    <input type="number" 
                           name="salary"
                           value="{{ old('salary', $request->salary ?? '') }}"
                           class="w-full pl-8 pr-4 py-3 rounded-lg border-2 border-cyan-200 focus:border-cyan-400 focus:ring focus:ring-cyan-200 focus:ring-opacity-50 transition-all text-lg" 
                           placeholder="Enter your salary"
                           id="salary-input"
                           min="0"
                           max="999999999999999999"
                           step="0.01"
                           required>
                </div>
            </div>
            <!-- Bouton de calcul -->
            <button type="submit" 
                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-lg transition-colors text-lg shadow-md hover:shadow-lg">
                Calculate
            </button>
        </form>
    </div>
</div>