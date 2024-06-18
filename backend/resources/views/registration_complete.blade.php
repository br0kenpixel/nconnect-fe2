@include("parts.header")
<p>Vážená/ý {{ $attendee->name }},</p>
<p>vaša registrácia zo dňa {{ $today }} na konferenciu nConnect <strong>prebehla úspešne</strong>.</p>
<br />
<p>Nasleduje zhnutie prednášok, na ktoré ste sa zaregistrovali.</p>

@foreach($schedules as $presentation)
    <p><em>{{ $presentation->start }} - {{ $presentation->end }}</em>: {{ $presentation->title }}</p>
@endforeach

<br />

<p>Ďakujeme za vašu registráciu.</p>
<p>Pokiaľ chcete vašu registráciu zmeniť alebo zrušiť, kliknite <a href="{{ $edit }}" target="_blank">sem</a>.</p>

<br />

<p>s pozdravom</p>
<p>Organizačný tím nConnect24</p>
<p><a href="https://nconnect.sk">nconnect.sk</a></p>
@include("parts.footer")