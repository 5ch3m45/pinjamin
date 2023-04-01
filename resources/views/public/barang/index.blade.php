@extends('layouts.public')

@section('title') Home @endsection

@section('style')
<style>
    /* fluid 5 columns */
    .grid-sizer, .grid-item { width: 100%; }
    @media (min-width: 576px) { .grid-sizer, .grid-item { width: 50%; } }
    @media (min-width: 768px) { .grid-sizer, .grid-item { width: 50%; } }
    @media (min-width: 992px) { .grid-sizer, .grid-item { width: 33.33%; } }
    @media (min-width: 1200px) { .grid-sizer, .grid-item { width: 25%; } }
    @media (min-width: 1400px) { .grid-sizer, .grid-item { width: 20%; } }
</style>
@endsection

@section('content')
    <div>
        <x-alert.success-and-error/>
        
        <div class="card mb-4">
            <div class="card-body">
                <h5>Filter</h5>
                <form class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari" value="">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-control">
                            <option value="nama">Nama</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <div>
                            <label class="form-label">&nbsp;</label>
                        </div>
                        <button type="sub" class="btn btn-primary me-2"><i class="bi bi-search"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid mb-2">
            @if($barangs)
            <div class="grid-sizer p-2">
                <div class="card shadow-none">
                    {{-- <img src="/assets/img/placeholder.jpeg" class="card-img-top" alt="..."> --}}
                    <div class="card-body shadow-none">
                        <h6 class="card-title">{{ $barangs[0]->nama }} {{ $barangs[0]->merk }}</h6>
                        <p class="card-text">{{ $barangs[0]->keterangan ?? '-' }}</p>
                        <p class="card-text mb-1"><strong>BNM</strong>: {{ $barangs[0]->bnm_nup ? explode('#', $barangs[0]->bnm_nup)[0] : '' }}</p>
                        <p class="card-text mb-1"><strong>NUP</strong>: {{ $barangs[0]->bnm_nup ? @explode('#', $barangs[0]->bnm_nup)[1] : '' }}</p>
                        <p class="card-text mb-1"><strong>Kondisi</strong>: {{ $barangs[0]->kondisi_text }}</p>
                        <a href="/troli/quick-add/{{ $barangs[0]->id }}" class="btn btn-primary mt-2">Pinjam sekarang</a>
                    </div>
                </div>
            </div>
            @endif
            @foreach ($barangs as $key => $barang)
            <div class="grid-item p-2">
                    <div class="card">
                        {{-- <img src="/assets/img/placeholder.jpeg" class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                            <h6 class="card-title">{{ $barang->nama }} {{ $barang->merk }}</h6>
                            <p class="card-text">{{ $barang->keterangan ?? '-' }}</p>
                            <p class="card-text mb-1"><strong>BNM</strong>: {{ $barang->bnm_nup ? explode('#', $barang->bnm_nup)[0] : '' }}</p>
                            <p class="card-text mb-1"><strong>NUP</strong>: {{ $barang->bnm_nup ? @explode('#', $barang->bnm_nup)[1] : '' }}</p>
                            <p class="card-text mb-1"><strong>Kondisi</strong>: {{ $barang->kondisi_text }}</p>
                            <p class="card-text mb-1"><strong>Lokasi</strong>: {{ $barang->lokasi->nama }}</p>
                            <div class="mt-3">
                                @if(collect($troli)->where('id', $barang->id)->first())
                                <a href="/troli/quick-delete/{{ $barang->id }}" class="btn btn-danger me-2">Hapus dari troli</a>
                                @else
                                <a href="/troli/quick-add/{{ $barang->id }}" class="btn btn-success me-2">Pinjam sekarang</a>
                                @endif
                                {{-- <a href="/barang/show/{{ $barang->id }}" class="btn btn-primary">Detail</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $barangs->links() }}</div>
    </div>
@endsection

@section('script')
<script src="/assets/js/masonry-layout@4.2.2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            // use element for option
            columnWidth: '.grid-sizer',
            percentPosition: true,
        });
    })
</script>
@endsection