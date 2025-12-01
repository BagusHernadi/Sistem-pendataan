@extends('layouts.app')

@section('content')

<style>
    /* BACKGROUND + OVERLAY */
    .dashboard-wrapper {
        position: relative;
        width: 100%;
        min-height: 92vh;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 20px;
        overflow: hidden;
    }

    .dashboard-wrapper::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: url('{{ asset('tampilan/img/bsn.jpg') }}') center/cover no-repeat;
        opacity: 0.7;
        z-index: 1;
    }

    /* CONTENT OVERLAY */
    .dashboard-box {
        text-align: center;
        max-width: 750px;
        width: 100%;
        padding: 40px 30px;
        position: relative;
        z-index: 2;
        animation: fadeIn 1.2s ease;
    }

    .dashboard-title {
        font-size: 38px;
        font-weight: 800;
        color: #004aad;
        margin-bottom: 10px;
    }

    .dashboard-desc {
        font-size: 18px;
        font-weight: 400;
        color: #0c0a12ff;
        margin-bottom: 35px;
    }

    /* MENU CARD */
    .menu-wrap {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: nowrap; /* 🔥 sejajar satu baris */
    }

    .menu-card {
        background: #007bff;
        padding: 18px 25px;
        border-radius: 10px;
        font-size: 17px;
        font-weight: 600;
        color: white;
        min-width: 200px;
        text-align: center;
        transition: .3s;
        box-shadow: 0 3px 7px rgba(0,0,0,0.2);
        border: 2px solid transparent;
    }

    .menu-card:hover {
        background: #003f7d;
        transform: translateY(-6px);
        border-color: #002a59;
    }

    /* RESPONSIVE MODE */
    @media(max-width: 900px){
        .menu-wrap { flex-wrap: wrap; } /* tablet otomatis turun */
        .menu-card { width: 45%; }
    }
    @media(max-width: 600px){
        .menu-card { width: 100%; } /* HP satu kolom */
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(25px);}
        to {opacity: 1; transform: translateY(0);}
    }

</style>

<div class="dashboard-wrapper">
    <div class="dashboard-box">
        <h1 class="dashboard-title">Sistem Pendataan</h1>
        <p class="dashboard-desc">
            Semua data Anggota Badan Standarsasi Nasional, rapi dan terpadu.
        </p>

        <div class="menu-wrap">
            <a href="{{ route('resident.index') }}" class="menu-card">Kelola Data</a>
            <a href="#" class="menu-card">Laporan</a>
            <a href="#" class="menu-card">Surat & Administrasi</a>
            <a href="#" class="menu-card">Pengaturan Sistem</a>
        </div>
    </div>
</div>

@endsection
