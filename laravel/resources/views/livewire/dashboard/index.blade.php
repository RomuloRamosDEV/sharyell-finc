<div class="livewire_dash">
    <div class="implements">
        <div class="center">
            <div class="filters">
                <input type="date" class="date_input" wire:model='start_date' style="height: 45px">
                <input type="date" class="date_input" wire:model='end_date' style="height: 45px">

                <div class="btn_search" wire:click='filterDate' wire:loading.class="opacity-50" wire:target='filterDate'>
                    <img src="{{asset('img/layout/search-circle.svg')}}"  alt="">
                </div>

                <div class="btn_clean" alt="limpar filtro" wire:click='cleanFilter' wire:loading.class="opacity-50" wire:target='cleanFilter'>
                    <img src="{{asset('img/layout/close.svg')}}" alt="">
                </div>
            </div>

            <div class="buttons" x-data="{pop_earn: false, pop_spend: false}">
                <div class="btn_add_spent" x-on:click="pop_spend = true">
                    <img src="{{asset('img/layout/remove-circle-outline.svg')}}" alt="remover">
                    Gastos
                </div>
                <div class="btn_add_earn" x-on:click="pop_earn = true">
                    <img src="{{asset('img/layout/add-circle-outline.svg')}}" alt="add">
                    Entradas
                </div>

                <livewire:dashboard.include-pop-up>
 
                <livewire:dashboard.exclude-pop-up>

                <div class="pop_up_bg" style="display:none" x-show="pop_earn"></div>
                <div class="pop_up_bg" style="display:none" x-show="pop_spend"></div>
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
                            <p class="free_spent" style="min-width:84px">R$ {{ number_format($total_free / 100, 2, ',', '.') }}</p>
                        </div>
    
                        <div class="spacing">
                            <p class="free_spent">Gasto total Fixo: </p>
                            <p class="free_spent" style="min-width:84px">R$ {{ number_format($total_fixed / 100, 2, ',', '.') }}</p>
                        </div>
    
                        <div class="spacing">
                            <p class="free_spent" style="font-size:17px"><b>Gasto total Geral: </b></p>
                            <p class="free_spent" style="min-width:84px;font-size:17px"><b>R$ {{ number_format($total_all / 100, 2, ',', '.') }}</b></p>
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
                
                <div class="goal" x-data="{pop_goal: false}">
                    <div class="bar_box">
                        @if (isset($goals->goal_spend))
                            @if ($goal_percent <= 20.10)
                                <div class="bar" style="width: {{$goal_percent}}%;background-color: #5ab65f"></div>
                            @elseif($goal_percent <= 69.00)
                                <div class="bar" style="width: {{$goal_percent}}%;background-color: #5ab65f"></div>
                                <div class="percentage" style="width:{{$goal_percent}}%">{{$goal_percent}}%</div>
                            @elseif($goal_percent >= 69.01 and $goal_percent <= 99.99)
                                <div class="bar" style="width: {{$goal_percent}}%;background-color: #61958E"></div>
                                <div class="percentage" style="width:{{$goal_percent}}%">{{$goal_percent}}%</div>
                            @elseif($goal_percent == 100.00)
                                <div class="bar" style="width: {{$goal_percent}}%;background-color: darkred"></div>
                                <div class="percentage" style="width:{{$goal_percent}}%">{{$goal_percent}}%</div>
                            @endif
                        @endif
                    </div>

                    @if (isset($goals->goal_spend))
                    <div class="goal_add">
                        <div class="number">Meta de Gasto: R$ {{ number_format($goals->goal_spend / 100, 2, ',', '.') }}</div>
                        <div class="adder" x-on:click="pop_goal = true">
                            <img src="{{asset('img/layout/add-circle-outline.svg')}}" alt="add">
                        </div>
                    </div>
                    @else 
                    <div class="goal_add">
                        <div class="number">Sem meta de gasto para este mês</div>
                        <div class="adder" x-on:click="pop_goal = true">
                            <img src="{{asset('img/layout/add-circle-outline.svg')}}" alt="add">
                        </div>
                    </div>
                    @endif

                    <livewire:dashboard.set-goal>
                    <div class="pop_up_bg" style="display:none" x-show="pop_goal"></div>
                </div>

                <div class="extra_info_2">
                    <div class="bg_spent {{ $balanco < 0 ? '' : 'greeny' }}">
                        <div class="spacing">
                            <p class="free_spent">Ganho Geral: </p>
                            <p class="free_spent" style="min-width:84px">R$ {{ number_format($earn_total_all / 100, 2, ',', '.') }}</p>
                        </div>

                        <div class="spacing">
                            <p class="free_spent">Gasto Geral:</p>
                            <p class="free_spent" style="min-width:84px">R$ {{ number_format($total_all / 100, 2, ',', '.') }}</p>
                        </div>
    
                        <div class="spacing">
                            <p class="free_spent" style="font-size:17px"><b>Balanço: </b></p>
                            <p class="free_spent" style="min-width:84px;font-size:17px"><b>R$ {{ number_format($balanco / 100, 2, ',', '.') }}</b></p>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>

<script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" 
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
    $(document).ready(function(){
        $('#currency').mask('000.000.000.000.000,00', {reverse: true});
        $('#currency_spend').mask('000.000.000.000.000,00', {reverse: true});
        $('#currency_goal').mask('000.000.000.000.000,00', {reverse: true});

        $('#submit_button_2').on('click', function(){
            var form = $('#spend_form')[0];
            if(form.checkValidity()) {
                $(this).prop('disabled', true);
                $(this).text('Enviando...');
                form.submit();
                setTimeout(function(){
                    $('#submit_button_2').prop('disabled', false);
                    $('#submit_button_2').text('Enviar');
                }, 6000);
            }
        });

        $('#submit_button').on('click', function(){
            var form = $('#earn_form')[0];
            if(form.checkValidity()) {
                $(this).prop('disabled', true);
                $(this).text('Enviando...');
                form.submit();
                setTimeout(function(){
                    $('#submit_button').prop('disabled', false);
                    $('#submit_button').text('Enviar');
                }, 6000);
            }
        });
    });
</script>

