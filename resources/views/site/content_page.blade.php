<section>
    <div class="inner_wrapper">
        <div class="container">
            {{--<h2>About Us</h2>--}}
            <h2>{{$page->name}}</h2>
            <div class="inner_section">
                <div class="row">
                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right"> {!! Html::image('assets/img/'.$page->images, '',array('class'=>'img-circle delay-03s animated wow zoomIn')) !!}</div>
                    <div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
                        <div class=" delay-01s animated fadeInDown wow animated">
                            {{--<h3>Lorem Ipsum has been the industry's standard dummy text ever..</h3><br/>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.PageMaker including versions of Lorem Ipsum.</p> <br/>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged like Aldus PageMaker including versions of Lorem Ipsum.</p>--}}
                            {!! $page->text !!}
                        </div>

                    </div>

                </div>

                {!! link_to(route('home'), 'Back')!!}
            </div>
        </div>
    </div>
</section>