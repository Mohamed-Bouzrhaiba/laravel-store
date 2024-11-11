@if (session()->has('success'))
<x-alert type="success">
    {{session('success')}}
</x-alert>
@endif
@if(session()->has('danger'))
<x-alert type="danger">
    {{session('danger')}}
</x-alert>
@endif
