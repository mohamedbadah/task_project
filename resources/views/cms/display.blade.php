@extends('cms.parent')
@section('content')
    {{-- @foreach ($categories as $item)
        <h1>{{ $item->name }}</h1>
    @endforeach --}}
    <h1 id="m"></h1>
    {{-- <span id="app">@{{ hello }}</span> --}}
@endsection
@section('scripts')
    <script src="https://unpkg.com/vue@3"></script>
    <script>
        // let app = Vue.createApp({
        //     data: function() {
        //         return {
        //             hello: "Dff",
        //             isVisible1: false,
        //             isVisible2: true,
        //             count: 0
        //         }
        //     },
        //     methods: {
        //         toggle() {
        //             this.isVisible1 = !this.isVisible1
        //         },
        //         updated() {
        //             console.log('update');
        //         },
        //         greet(geet) {
        //             console.log(geet);
        //         },
        //     }

        // });
        // app.mount('#app');
        let m = document.getElementById('m');
        axios.get('/display')
            .then(function(response) {
                // handle success
                console.log(response.data.categories);
                // this.hello = response.data.categories[13].name;
                m.innerHTML = response.data.categories[14].name;
                // window.location.href = "/index/"
                // location.reload()
            })
            .catch(function(error) {

                console.log(error);
            })
            .then(function() {
                // always executed
            });
        fetch('/display')
            .then(resp => resp.json())
            .then(result => {
                console.log(result);
            })
    </script>
@endsection
