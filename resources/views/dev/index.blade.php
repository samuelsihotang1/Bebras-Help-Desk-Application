@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Tentang Kami</h1>
                <p class="lead text-muted">Di balik layar sistem ini, kami adalah tim yang berdedikasi untuk memberikan solusi terbaik bagi Anda. Bertemu dengan kami:</p>
                {{-- <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p> --}}
            </div>
        </section>
    </div>



    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="https://source.unsplash.com/featured/?man"
                            data-holder-rendered="true">
                        <div class="card-body">
                           <h4 class="card-text" >Samuel Sihotang</h4>
                            <p class="card-text">Saya memiliki semangat yang tak pernah padam dalam mengejar kesempurnaan. Setiap baris kode yang saya tulis adalah representasi dari dedikasi dan komitmennya terhadap kualitas.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="#" class="text-decoration-none">LinkedIn</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="#" class="text-decoration-none">Github</a></button>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="https://source.unsplash.com/featured/?man"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <h4 class="card-text" >Estomihi Pangaribuan</h4>
                            <p class="card-text">Sebagai seorang developer,Saya selalu berfokus pada inovasi dan kesempurnaan dalam setiap kode yang saya tulis. Saya percaya bahwa teknologi adalah alat untuk menciptakan perubahan positif.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="https://www.linkedin.com/in/estomihi/" class="text-decoration-none" >LinkedIn</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="https://github.com/Estomihi100103" class="text-decoration-none">Github</a></button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="https://source.unsplash.com/featured/?man"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <h4 class="card-text" >Samuel Siagian</h4>
                            <p class="card-text">Saya selalu berusaha untuk berada di garis depan inovasi. Dengan rasa ingin tahu yang besar, saya selalu mencari cara baru untuk meningkatkan dan memperbaiki sistem.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="#" class="text-decoration-none">LinkedIn</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="#" class="text-decoration-none">Github</a></button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="https://source.unsplash.com/featured/?girl"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <h4 class="card-text" >Lile Manalu</h4>
                            <p class="card-text">Saya menghadapi setiap tantangan dengan tekad dan ketekunan. Bagi saya, setiap masalah adalah kesempatan untuk belajar dan tumbuh, mendorong diri saya untuk selalu memberikan yang terbaik.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="#" class="text-decoration-none">LinkedIn</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="#" class="text-decoration-none">Github</a></button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- 
    <footer class="text-muted">
        <div class="container">
            
            <p>Dalam dunia teknologi, satu hal yang tidak pernah berubah: tekad kami untuk melayani Anda.</p>
            <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a
                    href="../../getting-started/">getting started guide</a>.</p>
        </div>
    </footer> --}}

    <svg xmlns="http://www.w3.org/2000/svg" width="208" height="225" viewBox="0 0 208 225" preserveAspectRatio="none"
        style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;">
        <defs>
            <style type="text/css"></style>
        </defs><text x="0" y="11"
            style="font-weight:bold;font-size:11pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thumbnail</text>
    </svg>


@endsection
