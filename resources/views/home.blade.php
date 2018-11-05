@extends('theme.layout.app')

@section('content')
    <home :user="user" inline-template>
        <div class="container">
            <!-- Application Dashboard -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">{{__('Dashboard')}}</div>

                        <div class="card-body">
                            <h2>{{__('Your application\'s dashboard.')}}</h2>
                            <hr>
                            @if(auth()->user()->subscription())
                                <p>{{ __('Your used Subscription Points:') }} <span
                                            style="color:orange">{{ auth()->user()->points()->where('subscription_id', auth()->user()->subscription()->id)->sum('points') }}</span>/{{ (auth()->user()->sparkPlan((auth()->user()->subscription()->name)))->__get('points') }}
                                </p>
                            @endif
                            @if(auth()->user()->currentTeam())
                                <p>{{ __('Your Active Team (:team) used Subscription Points:',['team'=>auth()->user()->currentTeam()->name]) }}
                                    @if(auth()->user()->currentTeam()->subscription())
                                        <span style="color:orange">{{ auth()->user()->currentTeam()->points()->where('subscription_team_id', auth()->user()->currentTeam()->subscription()->id)->sum('points') }}</span>
                                        /{{ (auth()->user()->currentTeam()->sparkPlan((auth()->user()->currentTeam()->subscription()->name)))->__get('points') }}
                                    @else
                                        <span style="color:orange">0/0</span>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </home>
@endsection
