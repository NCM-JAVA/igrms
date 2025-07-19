@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")

@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 

        <div class="container">
            <div class="row inner_page">
                <div class="sidebar flex-shrink-0 col-lg-3 col-xs-12 pb-3 pe-lg-0">
                    <div class="left_menu ">
                    @foreach($data as $key => $val)
                    <div class="panorama-sidebar-item shadow">
    <a href="javascript:void(0)" class="imageLink panorama-link" 
       data-image="{{ URL::asset('public/upload/admin/cmsfiles/sanghralaya/thumbnail/' . $val->txtuplode) }}"
       data-title="{{ $val->title }}"
       data-description="{{ strip_tags($val->description) }}">
        <div class="panorama-link-content">
            <div class="panorama-link-title">{{ $val->title }}</div>
            <div class="panorama-link-icon">
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </a>
</div>

                                @endforeach
            </div>
        </div>

        <div class="col-lg-9 ">
            <div class="content-div">
                <h3 class="">{{$title}}</h3>
            </div>
            <div class="row d-flex">
                <div class="container">
                    <div class="wrapper">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div id="imageContainer">
                                    @if(count($data) > 0)
                                        <h4 id="mainTitle" class="mt-3">
                                            <a href="javascript:void(0)" id="mainLink" class="text-primary"
                                            data-image="{{ URL::asset('public/upload/admin/cmsfiles/sanghralaya/thumbnail/' . $data[0]->txtuplode) }}"
                                            data-title="{{ $data[0]->title }}"
                                            data-description="{{ strip_tags($data[0]->description) }}">
                                                {{ $data[0]->title }}
                                            </a>
                                        </h4>

                                        <div class="col-12 col-md-12">
                                            <div class="sanghralaya_image mt-3">
                                                <div id="panorama"></div>
                                            </div>
                                        </div>

                                        <div class="panorama-description-container">
    <div class="panorama-description-header">
        <i class="fas fa-info-circle description-icon"></i>
        <h5>About This View</h5>
    </div>
    <div class="panorama-description-content">
        <p id="mainDescription">{{ strip_tags($data[0]->description) }}</p>
    </div>
</div>

                                    @endif
                                </div>

                               <style>
/* Panorama Sidebar Styling */
.panorama-sidebar-item {
    margin-bottom: 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
    border-left: 4px solid #0a58ca;
}

.panorama-sidebar-item:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #e9ecef;
}

.panorama-link {
    display: block;
    padding: 12px 15px;
    text-decoration: none;
    color: #0a58ca !important;
}

.panorama-link-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.panorama-link-title {
    font-weight: 500;
    font-size: 16px;
    color: #212529;
}

.panorama-link-icon {
    color: #0a58ca;
    transition: transform 0.3s ease;
}

.panorama-sidebar-item:hover .panorama-link-icon {
    transform: translateX(3px);
}

/* Active state styling */
.panorama-sidebar-item.active {
    background-color: #e7f1ff;
    border-left-color: #0d6efd;
}

.panorama-sidebar-item.active .panorama-link-title {
    font-weight: 600;
    color: #0d6efd;
}







                                /* Panorama Description Styling */
.panorama-description-container {
    margin-top: 25px;
    margin-bottom: 30px;
    background-color: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border-left: 5px solid #0a58ca;
    border-right: 5px solid #0a58ca;
    transition: all 0.3s ease;
}

.panorama-description-container:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

.panorama-description-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e9ecef;
}

.description-icon {
    color: #0a58ca;
    font-size: 20px;
    margin-right: 10px;
}

.panorama-description-header h5 {
    margin: 0;
    color: #212529;
    font-weight: 600;
    font-size: 18px;
}

.panorama-description-content {
    color: #495057;
    line-height: 1.7;
    font-size: 16px;
}

#mainDescription {
    margin-bottom: 0;
    text-align: justify;
    hyphens: auto;
}

/* Add responsive adjustments */
@media (max-width: 768px) {
    .panorama-description-container {
        padding: 15px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    
    .panorama-description-header h5 {
        font-size: 16px;
    }
    
    .panorama-description-content {
        font-size: 15px;
        line-height: 1.6;
    }
}

                               </style>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const links = document.querySelectorAll('.imageLink');
                                        const mainTitle = document.getElementById('mainTitle');
                                        const mainDescription = document.getElementById('mainDescription');
                                        const mainLink = document.getElementById('mainLink');
                                        let viewer;

                                       // Alternative approach using standard configuration
                                        function initializeViewer(imageUrl) {
                                            if (viewer) {
                                                viewer.destroy();
                                            }

                                            viewer = pannellum.viewer('panorama', {
                                                "type": "equirectangular",
                                                "panorama": imageUrl,
                                                "autoLoad": true,
                                                "showControls": true,
                                                "mouseZoom": true,
                                                "hfov": 100,  // Adjust this value to control the initial zoom level
                                                "minHfov": 50,
                                                "maxHfov": 120,
                                                "autoRotate": -2,  // Disabled auto-rotation
                                                "compass": false,
                                                "horizonPitch": 0,
                                                "horizonRoll": 0,
                                                "haov": 360,  // Horizontal angle of view
                                                "vaov": 75,   // Vertical angle of view
                                                "vOffset": 0
                                            });
                                        }

                                        // Initial load with the first image
                                        initializeViewer(mainLink.getAttribute('data-image'));

                                        // Function to update the panorama and other content
                                        function updatePanorama(newImageUrl, newTitle, newDescription) {
                                            // Re-initialize viewer with the new image
                                            initializeViewer(newImageUrl);

                                            // Update main content
                                            mainTitle.textContent = newTitle;
                                            mainDescription.textContent = newDescription;

                                            // Update main link attributes
                                            mainLink.setAttribute('data-image', newImageUrl);
                                            mainLink.setAttribute('data-title', newTitle);
                                            mainLink.setAttribute('data-description', newDescription);
                                        }

                                        // Attach event listeners to links
                                        links.forEach(link => {
                                            link.addEventListener('click', function () {
                                                const newImageUrl = this.getAttribute('data-image');
                                                const newTitle = this.getAttribute('data-title');
                                                const newDescription = this.getAttribute('data-description');

                                                // Call the function to update the panorama
                                                updatePanorama(newImageUrl, newTitle, newDescription);
                                            });
                                        });
                                    });
                                </script>






                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection