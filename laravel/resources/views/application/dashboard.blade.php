<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="dashboard_external">
        <div class="centre">
            <div class="first_graph">
                <livewire:livewire-pie-chart
                    key="{{ $pieChartModel->reactiveKey() }}"
                    :pie-chart-model="$pieChartModel"
                />
            </div>
        </div>
    </div>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <div>
                    @livewire('teste-inicial', ['eu' => $eu])
                    <livewire:teste-inicial>
                </div>

                <div class="estilo">
                    <p>Meu estilo</p>
                </div>

                <div>
                    <img src="{{asset('img/layout/FjV0jd0acAAniBY.jpg')}}" alt="">
                </div>

            </div>
        </div>
    </div> --}}
</x-app-layout>
