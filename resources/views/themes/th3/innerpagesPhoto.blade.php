@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")

@php
$pageurl = clean_single_input(request()->segment(2));
$langid1 = session()->get('locale')??1;
@endphp
<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->


<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 10;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .modal.show {
        opacity: 1;
    }

    .modal-content {
        max-width: 80%;
        max-height: 80%;
        display: block;
        margin: 90px auto;
        transition: transform 0.5s ease;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }

    .arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        color: #fff;
        cursor: pointer;
    }

    .arrow.left {
        left: 10px;
    }

    .arrow.right {
        right: 10px;
    }

    /* .slideshow-button {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 5px 15px;
    border: none;
    cursor: pointer;
} */
</style>

<div class="container">
    <div class="row inner_page">
        <div class="sidebar flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
            <div class="left_menu">
                @include("../themes.th3.includes.sidebar")
            </div>
        </div>
    
        <!-- Name: Kesh Kumar
            Date: 02-11-23
            Reason: This modal is dymically change the image.  -->
    
        <div class="col-lg-9">
            <div class="content-div ">
                <h3 class="">{{$title}}</h3>
            </div>
            <div class="row d-flex">
                <?php foreach ($data as $val) { 
                   $images =  explode(",",$val->txtuplode);
                  ?>
                <div class="col-6 col-md-4 p-1">
                    <div class="photo-card">
                        <img style="aspect-ratio:4/2.5"
                            src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/<?php echo $images[0] ; ?>"
                            alt="Image 1" class="image"
                            onclick="openModal('{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/<?php echo $images[0] ; ?>', [<?php for ($i=0; $i <count($images) ; $i++) { ?>'{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/<?php echo $images[$i] ; ?>',<?php } ?>])">
    
                        <div class="category">{{ $val->title??''}}</div>
                        <!-- <h5>A heading that must span over two lines</h5> -->
                    </div>
                </div>
                <?php }?>
    
            </div>
    
            <!-- <p class="page-updated-date px-3 text-align-right">{{get_title('lastupdate',$langid1)->title}}:
                {{ get_last_updated_date($title) }} </p> -->
        </div>
    
    </div>
</div>


<!-- <div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <p style="position:absolute; width: 100%; display: flex; justify-content: center; color: #fff;">sample
        test</p>
    <img class="modal-content" id="img01">
    <button class="slideshow-button" onclick="nextSlide()">Next</button>
</div> -->

<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <p style="position:absolute; width: 100%; display: flex; justify-content: center; color: #fff;">sample test</p>
    <img class="modal-content" id="img01">
    <div class="arrow left" onclick="prevSlide()">&#10094;</div>
    <div class="arrow right" onclick="nextSlide()">&#10095;</div>
    <!-- <button class="slideshow-button" onclick="nextSlide()">Next</button> -->
</div>

<script>
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("img01");
    let images = [];
    let currentImageIndex = 0;

    function openModal(imageSrc, categoryImages) {
        modal.style.display = "block";
        setTimeout(() => {
            modal.classList.add("show");
            modalImg.src = imageSrc;
            images = categoryImages;
            currentImageIndex = categoryImages.indexOf(imageSrc);
        }, 10);
    }

    function closeModal() {
        modal.classList.remove("show");
        setTimeout(() => {
            modal.style.display = "none";
        }, 500);
    }

    function nextSlide() {
        if (images.length === 0) return;
        currentImageIndex = (currentImageIndex + 1) % images.length;
        modalImg.src = images[currentImageIndex];
    }
    function prevSlide() {
        if (images.length === 0) return;
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        modalImg.src = images[currentImageIndex];
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    };
</script>


@endsection