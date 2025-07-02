@if($soal->tipe_media == 'video' && $soal->url_media)
    <video controls src="{{ $soal->url_media) }}"></video>
@elseif($soal->tipe_media == 'audio' && $soal->url_media)
    <audio controls src="{{ $soal->url_media) }}"></audio>
@endif
@foreach($soal->pilihanJawabans as $pilihan)
    <label>
        <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $pilihan->id }}">
        {{ $pilihan->jawaban }}
    </label>
@endforeach
