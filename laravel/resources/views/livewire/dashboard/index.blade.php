<div class="centre">
    <div class="implements">
        <div class="filters">
            <input type="date" class="date_input" wire:model='start_date'>
            <input type="date" class="date_input" wire:model='end_date'>

            <div class="btn_search" wire:click='filterDate'>REFRESH ICON HERE?????</div>
            <div class="calss" alt="limpar filtro">X</div>
        </div>

        <div class="buttons">
            <div class="btn_add_spent">+ Gastos</div>
            <div class="btn_add_earn">+ Entradas</div>
        </div>
    </div>

    <h2 class="super_title mt-10">Gastos</h2>

    <div class="father">
        <div class="card">
            <div class="infos">
                <h3 class="title">Gastos Livres</h3>
            </div>

            <div class="graph_free">
                @if (count($categories) > 0)  
                    <livewire:livewire-pie-chart
                        key="{{ $pieChartModel->reactiveKey() }}"
                        :pie-chart-model="$pieChartModel"
                    />
                @else
                    <p class="no_data">
                        Sem dados registrados
                    </p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="infos">
                <h3 class="title">Gastos Fixos</h3>
            </div>

            <div class="graph_free">
                <livewire:livewire-pie-chart
                    key="{{ $pieChartModelFixo->reactiveKey() }}"
                    :pie-chart-model="$pieChartModelFixo"
                />
            </div>
        </div>

        <div class="card_liner">
            <div class="infos">
                <h3 class="title">Gastos por Mês</h3>
            </div>

            <div class="graph_liner">
                <livewire:livewire-line-chart
                    key="{{ $lineChartModel->reactiveKey() }}"
                    :line-chart-model="$lineChartModel"
                />
            </div>
        </div>
    </div>

    <h2 class="super_title mt-20">Investimentos</h2>

    <div class="father">
        <div class="card">
            <div class="infos">
                <h3 class="title">Investimentos</h3>
            </div>

            <div class="graph_free">
                <livewire:livewire-pie-chart
                    key="{{ $pieChartModelInvest->reactiveKey() }}"
                    :pie-chart-model="$pieChartModelInvest"
                />
            </div>
        </div>
    </div>
</div>
