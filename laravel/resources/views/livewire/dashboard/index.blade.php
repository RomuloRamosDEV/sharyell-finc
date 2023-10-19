<div class="livewire_dash">
    <div class="implements">
        <div class="center">
            <div class="filters">
                <input type="date" class="date_input" wire:model='start_date'>
                <input type="date" class="date_input" wire:model='end_date'>

                <div class="btn_search" wire:click='filterDate' wire:loading.class="opacity-50" wire:target='filterDate'>
                    <img src="{{asset('img/layout/search-circle.svg')}}"  alt="">
                </div>

                <div class="btn_clean" alt="limpar filtro" wire:click='cleanFilter' wire:loading.class="opacity-50" wire:target='cleanFilter'>
                    <img src="{{asset('img/layout/close.svg')}}" alt="">
                </div>
            </div>

            <div class="buttons">
                <div class="btn_add_spent">
                    <img src="{{asset('img/layout/remove-circle-outline.svg')}}" alt="remover">
                    Gastos
                </div>
                <div class="btn_add_earn">
                    <img src="{{asset('img/layout/add-circle-outline.svg')}}" alt="add">
                    Entradas
                </div>
            </div>
        </div>
    </div>

    <div class="centre">
        <h2 class="super_title mt-5">Gastos</h2>

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
                    @if (count($categories_fixo) > 0)  
                        <livewire:livewire-pie-chart
                            key="{{ $pieChartModelFixo->reactiveKey() }}"
                            :pie-chart-model="$pieChartModelFixo"
                        />
                    @else
                        <p class="no_data">
                            Sem dados registrados
                        </p>
                    @endif
                </div>
            </div>

            <div class="third_card">
                <div class="extra_info">
                    <div class="bg_spent">
                        <div class="spacing">
                            <p class="free_spent">Gasto total Livre: </p>
                            <p class="free_spent" style="min-width:84px">R$ {{$total_free}}</p>
                        </div>
    
                        <div class="spacing">
                            <p class="free_spent">Gasto total Fixo: </p>
                            <p class="free_spent" style="min-width:84px">R$ {{$total_fixed}}</p>
                        </div>
    
                        <div class="spacing">
                            <p class="free_spent" style="font-size:17px"><b>Gasto total Geral: </b></p>
                            <p class="free_spent" style="min-width:84px;font-size:17px"><b>R$ {{$total_all}}</b></p>
                        </div>
                    </div>
    
                    
                    <h2 class="month_title">
                        @if (isset($start_date))
                            {{date("d/m/Y", strtotime($start_date))}}
                        @else
                            {{$monthNames[$month]}}
                        @endif
                    </h2>
                </div>
                
                <div class="goal">
                    <div class="bar"></div>
                    @if (isset($goals->goal_spend))
                    <div class="goal_add">
                        <div class="number">Meta R${{$goals->goal_spend}}</div>
                        <div class="adder"><img src="{{asset('img/layout/add-circle-outline.svg')}}" alt="add"></div>
                    </div>
                    @else 
                    <div class="goal_add">
                        <div class="number">Meta Não Definida</div>
                        <div class="adder"><img src="{{asset('img/layout/add-circle-outline.svg')}}" alt="add"></div>
                    </div>
                    @endif
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
    </div>
</div>
