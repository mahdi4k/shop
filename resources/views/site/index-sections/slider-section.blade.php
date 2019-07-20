<div class="banner">



    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
         
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-inner">
                    @foreach($slider as $slide)
                    <div class="carousel-item  @if($loop->first) active @endif">
                        <img style="border-radius:10px" src="{{ url('upload').'/'.$slide->img }}" alt="First slide">

                    </div>

                    @endforeach
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>