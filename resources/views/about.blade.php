@extends('layouts.layout01')

@section('content')
<div class="preloader"></div>

{{-- Titolo--}}
<div class="dashboard__title ">
    <div class="wrapper">
        <div class="title">
            <div class="left">
                <h3>Chi siamo</h3>
                <p>Progetto realizzato da</p>
            </div>
            <div class="right">
            </div>
        </div>
    </div>
</div>

{{-- ---- --}}


<div class="about__content">
  <div class="wrapper">
    <a class="box" href="https://www.linkedin.com/in/andrea-pacifico/" target="_blank">
      <div class="left">
          <h3>Andrea Pacifico</h3>
          <p>Jr. Full Stack Web Developer</p>
      </div>
      <div class="right">
          <i class="lni lni-linkedin-original"></i>
      </div>
    </a>
    <a class="box" href="https://www.linkedin.com/in/luisa-logozzo/" target="_blank">
      <div class="left">
      <h3>Luisa Logozzo</h3>
      <p>Jr. Full Stack Web Developer</p>
      </div>
      <div class="right">
          <i class="lni lni-linkedin-original"></i>
      </div>
    </a>
    <a class="box" href="https://www.linkedin.com/in/gianauriofiore/" target="_blank">
      <div class="left">
          <h3>Gianuario Fiore</h3>
          <p>Jr. Full Stack Web Developer</p>
      </div>
      <div class="right">
          <i class="lni lni-linkedin-original"></i>
      </div>
    </a>
    <a class="box" href="https://www.linkedin.com/in/marcocarone/" target="_blank">
      <div class="left">
          <h3>Marco Carone</h3>
          <p>Jr. Full Stack Web Developer e UX Designer</p>
      </div>
      <div class="right">
          <i class="lni lni-linkedin-original"></i>
      </div>
    </a>
    <a class="box" href="https://www.linkedin.com/in/nicola-baglini-9a8701190/" target="_blank">
      <div class="left">
          <h3>Nicola Baglini</h3>
          <p>Jr. Full Stack Web Developer</p>
      </div>
      <div class="right">
          <i class="lni lni-linkedin-original"></i>
      </div>
    </a>
  </div>
</div>


@endsection
