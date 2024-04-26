@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row tengah">
            <div class="col-md-6">
                <div class="text-center">
                    {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}
                    <div class="session">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="left">
                            <?xml version="1.0" encoding="UTF-8"?>
                        </div>
                        <div class="text-center">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <h4>Reset Your Password</h4>
                                <p>We'll send link to your email for reset your password</p>
                                <div class="floating-label">
                                    <input id="email" type="email" class="form-control"
                                        @error('email') is-invalid @enderror name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{-- <label for="email">{{ __('Email Address') }}</label>     --}}
                                    <div class="icon">
                                        <?xml version="1.0" encoding="UTF-8"?>
                                        <svg enable-background="new 0 0 100 100" version="1.1" viewBox="0 0 100 100"
                                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <style type="text/css">
                                                .st0 {
                                                    fill: none;
                                                }
                                            </style>
                                            <g transform="translate(0 -952.36)">
                                                <path
                                                    d="m17.5 977c-1.3 0-2.4 1.1-2.4 2.4v45.9c0 1.3 1.1 2.4 2.4 2.4h64.9c1.3 0 2.4-1.1 2.4-2.4v-45.9c0-1.3-1.1-2.4-2.4-2.4h-64.9zm2.4 4.8h60.2v1.2l-30.1 22-30.1-22v-1.2zm0 7l28.7 21c0.8 0.6 2 0.6 2.8 0l28.7-21v34.1h-60.2v-34.1z" />
                                            </g>
                                            <rect class="st0" width="100" height="100" />
                                        </svg>
                                    </div>
                                </div>
                                <button type="submit">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, "San Francisco", Helvetica, Arial, sans-serif;
        font-weight: 300;
        margin: 0;
    }

    $primary: rgb(182, 157, 230);


    html,
    body {
        height: 100vh;
        width: 100vw;
        margin: 0 0;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        background: #f3f2f2;
    }

    h4 {
        font-size: 24px;
        font-weight: 600;
        color: #000;
        opacity: .85;
    }

    label {
        font-size: 12.5px;
        color: #000;
        opacity: .8;
        font-weight: 400;
    }

    .tengah {
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 80vh;
    }

    form {
        padding: 40px 30px;
        background: #fefefe;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding-bottom: 20px;
        width: 430px;

        h4 {
            margin-bottom: 20px;
            color: rgba(#000, .5);

            span {
                color: rgba(#000, 1);
                font-weight: 700;
            }
        }

        p {
            line-height: 155%;
            margin-bottom: 5px;
            font-size: 16px;
            color: #000;
            opacity: .65;
            font-weight: 400;
            max-width: 350px;
            margin-bottom: 10px;
        }

        button {
            margin-left: auto;
            margin-top:20px;
            border-radius: 30px 30px 30px 30px;
        }


    }

    a.discrete {
        color: rgba(#000, .4);
        font-size: 14px;
        border-bottom: solid 1px rgba(#000, .0);
        padding-bottom: 4px;
        margin-left: auto;
        font-weight: 300;
        transition: all .3s ease;
        margin-top: 40px;

        &:hover {
            border-bottom: solid 1px rgba(#000, .2);
        }
    }

    button {
        -webkit-appearance: none;
        width: auto;
        min-width: 100px;
        border-radius: 24px;
        text-align: center;
        padding: 15px 40px;
        margin-top: 5px;
        background-color: #b08bf8;
        color: #fff;
        font-size: 14px;
        margin-left: auto;
        font-weight: 500;
        box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, .13);
        border: none;
        transition: all .3s ease;
        outline: 0;

        &:hover {
            transform: translateY(-3px);
            box-shadow: 0 2px 6px -1px rgba($primary, .65);

            &:active {
                transform: scale(.99);
            }
        }
    }

    input {
        font-size: 16px;
        padding: 20px 0px;
        height: 56px;
        border: none;
        border-bottom: solid 1px rgba(0, 0, 0, .1);
        background: #fff;
        width: 280px;
        box-sizing: border-box;
        transition: all .3s linear;
        color: #000;
        font-weight: 400;
        -webkit-appearance: none;

        &:focus {
            border-bottom: solid 1px $primary;
            outline: 0;
            box-shadow: 0 2px 6px -8px rgba($primary, .45);
        }
    }

    .floating-label {
        position: relative;
        margin-bottom: 10px;
        width: 100%;

        label {
            position: absolute;
            top: calc(50% - 7px);
            left: 0;
            opacity: 0;
            transition: all .3s ease;
            padding-left: 44px;
        }

        input {
            width: calc(100% - 44px);
            margin-left: auto;
            display: flex;
        }

        .icon {
            position: absolute;
            top: 0;
            left: 0;
            height: 56px;
            width: 44px;
            display: flex;

            svg {
                height: 30px;
                width: 30px;
                margin: auto;
                opacity: .15;
                transition: all .3s ease;

                path {
                    transition: all .3s ease;
                }
            }
        }

        input:not(:placeholder-shown) {
            padding: 28px 0px 12px 0px;
        }

        input:not(:placeholder-shown)+label {
            transform: translateY(-10px);
            opacity: .7;
        }

        input:valid:not(:placeholder-shown)+label+.icon {
            svg {
                opacity: 1;

                path {
                    fill: $primary;
                }
            }
        }

        input:not(:valid):not(:focus)+label+.icon {
            animation-name: shake-shake;
            animation-duration: .3s;
        }
    }

    $displacement: 3px;

    @keyframes shake-shake {
        0% {
            transform: translateX(-$displacement);
        }

        20% {
            transform: translateX($displacement);
        }

        40% {
            transform: translateX(-$displacement);
        }

        60% {
            transform: translateX($displacement);
        }

        80% {
            transform: translateX(-$displacement);
        }

        100% {
            transform: translateX(0px);
        }
    }

    .session {
        display: flex;
        flex-direction: row;
        width: auto;
        height: auto;
        margin: auto auto;
        background: #c18cf2;
        border-radius: 4px;
        box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, .12);
    }

    .left {
        width: 220px;
        height: auto;
        min-height: 100%;
        position: relative;
        background-image: url("https://images.pexels.com/photos/114979/pexels-photo-114979.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
        background-size: cover;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;

        svg {
            height: 40px;
            width: auto;
            margin: 20px;
        }
    }
</style>
