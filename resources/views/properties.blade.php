@extends('layout.main')
@section('content')

<div class="container mt-5 pt-5">
    <h2 class="mt-5">Explore All Latest Properties  @if ($search != "") {{"("}} Search: {{$search." )" }} @endif @if ($purpose != "") {{"("}} Purpose: {{PurposeName($purpose)." )" }} @endif  @if ($category_id != "") {{"("}} Category: {{Custom::categoryName($category_id)." )" }} @endif </h2>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae, eveniet harum suscipit numquam culpa distinctio officiis eius sit labore modi corporis quia. Deleniti voluptate illum quasi officia accusantium aliquam eaque!</p>
</div>

@if (session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
@if (session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif

@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif

<div class="container mt-4 pt-4">
    <div class="row">
        @foreach ($listing as $list)
        <div class="col-md-3 col-lg-3 col-">
          <div class="property-item mb-5 border">
            <a href="#" class="img">
              <img src="{{url('Backend/listing_images')}}/{{$list->image}}" alt="Image" class="img-fluid" style="height: 260px;" />
            </a>

            <div class="property-content">
              <div class="price mb-2"><span>Rs. {{$list->price}}</span></div>
              <div>
                <span class="d-block mb-2 text-dark"
                  >{{purposeName($list->purpose)}}</span
                >
                <span class="city property-title d-block mb-2">{{$list->title}}</span>
				<span class="icon-location-arrow me-2"></span>
				<span class="property-title d-block" style="font-size: 16px; font-weight:700;">{{cityName($list->city)}}, {{$list->address}}</span>

                <div class="specs d-flex mb-3 mt-2">
                  <span class="d-block d-flex align-items-center me-3">
                    <span class="icon-home me-2"></span>
                    <span class="caption">{{Custom::categoryName($list->category_id)}}</span>
                  </span>
                  <span class="d-block d-flex align-items-center">
                    <span class="icon-user me-2"></span>
                    <span class="caption">{{Custom::userName($list->author_id)}}</span>
                  </span>
                </div>

                <a
                  href="{{url('displayProperty')}}/{{$list->list_id}}"
                  class="btn btn-primary py-2 px-3"
                  >See details</a
                >
              </div>
            </div>
          </div>
        </div>
        @endforeach
  </div>
</div>


<div class="section">
	<div class="container">
		<h3 class="mb-4 ">Featured Listing</h3>
	  <div class="row">
		<div class="col-12">
		  <div class="property-slider-wrap">
			<div class="property-slider">
       
			  <div class="property-item">
				<a href="#" class="img">
				  <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
				</a>

				<div class="property-content">
				  <div class="price mb-2"><span>$1,291,000</span></div>
				  <div>
					<span class="d-block mb-2 text-black-50"
					  >5232 California Fake, Ave. 21BC</span
					>
					<span class="city d-block mb-3">California, USA</span>

					<div class="specs d-flex mb-4">
					  <span class="d-block d-flex align-items-center me-3">
						<span class="icon-bed me-2"></span>
						<span class="caption">2 beds</span>
					  </span>
					  <span class="d-block d-flex align-items-center">
						<span class="icon-bath me-2"></span>
						<span class="caption">2 baths</span>
					  </span>
					</div>

					<a
					  href="#"
					  class="btn btn-primary py-2 px-3"
					  >See details</a
					>
				  </div>
				</div>
			  </div>
			  <!-- .item -->
             @foreach ($listing as $list)
			  <div class="property-item">
				<a href="#" class="img">
				  <img src="{{url('Backend/listing_images')}}/{{$list->image}}" alt="Image" class="img-fluid" />
				</a>

				<div class="property-content">
				  <div class="price mb-2"><span>{{$list->price}}</span></div>
				  <div>
					<span class="d-block mb-2 text-black-50"
					  >{{$list->title}}</span
					>
					<span class="city d-block mb-3">{{cityName($list->city)}}, {{$list->address}}</span>

					<div class="specs d-flex mb-4">
					  <span class="d-block d-flex align-items-center me-3">
						<span class="icon-bed me-2"></span>
						<span class="caption">{{Custom::categoryName($list->category_id)}}</span>
					  </span>
					  <span class="d-block d-flex align-items-center">
						<span class="icon-user me-2"></span>
						<span class="caption">{{Custom::userName($list->author_id)}}</span>
					  </span>
					</div>

					<a
					  href="#"
					  class="btn btn-primary py-2 px-3"
					  >See details</a
					>
				  </div>
				</div>
			  </div>
			  	 
			 @endforeach
			  <!-- .item -->			  

			  <div class="property-item">
				<a href="#" class="img">
				  <img src="images/img_1.jpg" alt="Image" class="img-fluid" />
				</a>

				<div class="property-content">
				  <div class="price mb-2"><span>$1,291,000</span></div>
				  <div>
					<span class="d-block mb-2 text-black-50"
					  >5232 California Fake, Ave. 21BC</span
					>
					<span class="city d-block mb-3">California, USA</span>

					<div class="specs d-flex mb-4">
					  <span class="d-block d-flex align-items-center me-3">
						<span class="icon-bed me-2"></span>
						<span class="caption">2 beds</span>
					  </span>
					  <span class="d-block d-flex align-items-center">
						<span class="icon-bath me-2"></span>
						<span class="caption">2 baths</span>
					  </span>
					</div>

					<a
					  href="property-single.html"
					  class="btn btn-primary py-2 px-3"
					  >See details</a
					>
				  </div>
				</div>
			  </div>
			  <!-- .item -->
			</div>

			<div
			  id="property-nav"
			  class="controls"
			  tabindex="0"
			  aria-label="Carousel Navigation"
			>
			  <span
				class="prev"
				data-controls="prev"
				aria-controls="property"
				tabindex="-1"
				>Prev</span
			  >
			  <span
				class="next"
				data-controls="next"
				aria-controls="property"
				tabindex="-1"
				>Next</span
			  >
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>

 
 
@endsection