<div class="container ">
                
    @if (isset($errors) && $errors->any())
        <br>
        <div class="alert alert-danger bg-white">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <br>
        <div class="alert alert-success bg-white">
            <ul>
                @foreach (session()->get() as $message )
                    <li>
                        {{ $message }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif                

    @if (session()->has('error'))
        <br>
        <div class="alert alert-danger bg-white">
            <ul>
                
                    <li>
                        {{ session()->get('error') }}
                    </li>
                
            </ul>
        </div>
    @endif        

</div>
