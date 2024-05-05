<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="JS/map.js" defer></script> -->
    <link rel="stylesheet" href="/view/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="/Js/bootstrap.js" defer></script>
    <link href="/view/img/foodtitle.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="/view/css/myCommon.css">
    <title>맛집검색</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand nav-my text-light" href="#">단짠단짠</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            맛집
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="board/list">나만의 맛집 저장소</a></li>
                            <li><a class="dropdown-item" href="board/list?b_type=1">다음에 가볼 맛집</a></li>
                            <li><a class="dropdown-item" href="#">맛집찾기</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="/user/logout" class="navbar-nav nav-link text-light" role="button"><?php isset($_SESSION["u_id"]) ? print("Log Out") : print("Log In"); ?></a>
            </div>
        </div>
    </nav>
    <div class="place-title">
        <h1 class="good-h1 animate__animated animate__bounce animate__delay-2s">맛집 검색</h1>
    </div>
    <div class="place-search mt-5 mb-3">
        <form onsubmit="searchPlaces(); return false;">
            키워드 : <input type="text" value="대구 맛집" id="keyword" size="15">
            <button type="submit"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACwUlEQVR4nO2YPWhUQRDHf3JnDFrkKUEDGgsxlUFsBG38QlOLqIVoo4igjYq2KTRV/CgsrLVSYnEWijFgSjEWKRICsbHwAyxEiaiQxHiyYQ7G4ZLc5e3ue4H3g+3u/vNmd3Z2ZqCgoKCgQbqBa0AFeAd8A6rAT+AT8AroB3qAMjmjDJwBRuWjG11fgD6gnRywH5ho0gG7poDLQCkLB0qym3N1PmxWQug2cAU4BVwCbgCPVbjZNQx0xHSiBRio8yHvgXPAhiX+vxo4DAwuoNEV6yQGjPHfEhrOwWY5BEwavQ/AFgLTZ4x+Bnan1EyAF0bXJY5WAl7sOeNEp8eTfmKcuUOgFDthwintSVjWmRQ+C+z0bGP+ndC75e5ECLYD08pOxbeBUZNZlnOxG+WesvUX2Oaz7NCn4VJsSDYCM8pery/h6yZu1xOeIWXztS/Rp0rUvdgxcJWA3rw1PkT1g3WLOOwx4ezCOzVTStDVTjHYahw54kP0jxI8TRxcKGlHjvoQ/aUELxKHTcaRAz5EPyrBm8Rhl3Fkhw/RYSX4iDicMI+il5Tfr0S/B37VazxUNsd8ifaYY3ZNUUhcgfo1RBVclkFBTdh1diE5bzZuX8iGynV2IVgrfU7NzohvA+3mYZyUzs43982GHQtgY/5V10Zeeh6ynTX6Q8AqAlAyqbgq7anr7NJywZTubmS0mYB0SGNlBwWus1vunbDh5NZ4oND9jy4Z2WjD09LZuaaoEcqSnfTFtuttDGc6F5j1zkhsu35ir/yuRWonN0g4CTww74QOp/EsnGkF7krjU025BuVOJPLx0Z1BdroiNVGzDoxIitXZKVNnkGlHr/TYi53SmJQdi73YmTujG6NuqcuOAwelFG+mik3y4owP2oA3ddL9UhP/XNJWOJNTkjp35jkrlMQ484MVTAI8k7b7atYfU1BQQHb8AzKDbE5R/konAAAAAElFTkSuQmCC"></button>
        </form>
    </div>
    <div class="main-map">
        <div class="map_wrap">
            <div id="menu_wrap" class="bg_white">
                <div class="option">
                </div>
                <!-- <hr> -->
                <ul id="placesList"></ul>
                <div id="pagination"></div>
            </div>
            <div id="map" style="width:500px;height:410px;position:relative;overflow:hidden;"></div>
        </div>
    </div>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=9576864000a167aef2537af3bf9218b9&libraries=services"></script>
    <script>
        // 마커를 담을 배열입니다
        var markers = [];

        var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
            mapOption = {
                center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
                level: 3 // 지도의 확대 레벨
            };

        // 지도를 생성합니다    
        var map = new kakao.maps.Map(mapContainer, mapOption);

        // 장소 검색 객체를 생성합니다
        var ps = new kakao.maps.services.Places();

        // 검색 결과 목록이나 마커를 클릭했을 때 장소명을 표출할 인포윈도우를 생성합니다
        var infowindow = new kakao.maps.InfoWindow({
            zIndex: 1
        });

        // 키워드로 장소를 검색합니다
        searchPlaces();

        // 키워드 검색을 요청하는 함수입니다
        function searchPlaces() {

            var keyword = document.getElementById('keyword').value;

            if (!keyword.replace(/^\s+|\s+$/g, '')) {
                alert('키워드를 입력해주세요!');
                return false;
            }

            // 장소검색 객체를 통해 키워드로 장소검색을 요청합니다
            ps.keywordSearch(keyword, placesSearchCB);
        }

        // 장소검색이 완료됐을 때 호출되는 콜백함수 입니다
        function placesSearchCB(data, status, pagination) {
            if (status === kakao.maps.services.Status.OK) {

                // 정상적으로 검색이 완료됐으면
                // 검색 목록과 마커를 표출합니다
                displayPlaces(data);

                // 페이지 번호를 표출합니다
                displayPagination(pagination);

            } else if (status === kakao.maps.services.Status.ZERO_RESULT) {

                alert('검색 결과가 존재하지 않습니다.');
                return;

            } else if (status === kakao.maps.services.Status.ERROR) {

                alert('검색 결과 중 오류가 발생했습니다.');
                return;

            }
        }

        // 검색 결과 목록과 마커를 표출하는 함수입니다
        function displayPlaces(places) {

            var listEl = document.getElementById('placesList'),
                menuEl = document.getElementById('menu_wrap'),
                fragment = document.createDocumentFragment(),
                bounds = new kakao.maps.LatLngBounds(),
                listStr = '';

            // 검색 결과 목록에 추가된 항목들을 제거합니다
            removeAllChildNods(listEl);

            // 지도에 표시되고 있는 마커를 제거합니다
            removeMarker();

            for (var i = 0; i < places.length; i++) {

                // 마커를 생성하고 지도에 표시합니다
                var placePosition = new kakao.maps.LatLng(places[i].y, places[i].x),
                    marker = addMarker(placePosition, i),
                    itemEl = getListItem(i, places[i]); // 검색 결과 항목 Element를 생성합니다

                // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
                // LatLngBounds 객체에 좌표를 추가합니다
                bounds.extend(placePosition);

                // 마커와 검색결과 항목에 mouseover 했을때
                // 해당 장소에 인포윈도우에 장소명을 표시합니다
                // mouseout 했을 때는 인포윈도우를 닫습니다
                (function(marker, title) {
                    kakao.maps.event.addListener(marker, 'mouseover', function() {
                        displayInfowindow(marker, title);
                    });

                    kakao.maps.event.addListener(marker, 'mouseout', function() {
                        infowindow.close();
                    });

                    itemEl.onmouseover = function() {
                        displayInfowindow(marker, title);
                    };

                    itemEl.onmouseout = function() {
                        infowindow.close();
                    };
                })(marker, places[i].place_name);

                fragment.appendChild(itemEl);
            }

            // 검색결과 항목들을 검색결과 목록 Element에 추가합니다
            listEl.appendChild(fragment);
            menuEl.scrollTop = 0;

            // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
            map.setBounds(bounds);
        }

        // 검색결과 항목을 Element로 반환하는 함수입니다
        function getListItem(index, places) {

            var el = document.createElement('li'),
                itemStr = '<span class="markerbg marker_' + (index + 1) + '"></span>' +
                '<div class="info">' +
                '   <h5>' + places.place_name + '</h5>';

            if (places.road_address_name) {
                itemStr += '    <span>' + places.road_address_name + '</span>' +
                    '   <span class="jibun gray">' + places.address_name + '</span>';
            } else {
                itemStr += '    <span>' + places.address_name + '</span>';
            }

            itemStr += '  <span class="tel">' + places.phone + '</span>' +
                '</div>';

            el.innerHTML = itemStr;
            el.className = 'item';

            return el;
        }

        // 마커를 생성하고 지도 위에 마커를 표시하는 함수입니다
        function addMarker(position, idx, title) {
            var imageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
                imageSize = new kakao.maps.Size(36, 37), // 마커 이미지의 크기
                imgOptions = {
                    spriteSize: new kakao.maps.Size(36, 691), // 스프라이트 이미지의 크기
                    spriteOrigin: new kakao.maps.Point(0, (idx * 46) + 10), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
                    offset: new kakao.maps.Point(13, 37) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
                },
                markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions),
                marker = new kakao.maps.Marker({
                    position: position, // 마커의 위치
                    image: markerImage
                });

            marker.setMap(map); // 지도 위에 마커를 표출합니다
            markers.push(marker); // 배열에 생성된 마커를 추가합니다

            return marker;
        }

        // 지도 위에 표시되고 있는 마커를 모두 제거합니다
        function removeMarker() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }

        // 검색결과 목록 하단에 페이지번호를 표시는 함수입니다
        function displayPagination(pagination) {
            var paginationEl = document.getElementById('pagination'),
                fragment = document.createDocumentFragment(),
                i;

            // 기존에 추가된 페이지번호를 삭제합니다
            while (paginationEl.hasChildNodes()) {
                paginationEl.removeChild(paginationEl.lastChild);
            }

            for (i = 1; i <= pagination.last; i++) {
                var el = document.createElement('a');
                el.href = "#";
                el.innerHTML = i;

                if (i === pagination.current) {
                    el.className = 'on';
                } else {
                    el.onclick = (function(i) {
                        return function() {
                            pagination.gotoPage(i);
                        }
                    })(i);
                }

                fragment.appendChild(el);
            }
            paginationEl.appendChild(fragment);
        }

        // 검색결과 목록 또는 마커를 클릭했을 때 호출되는 함수입니다
        // 인포윈도우에 장소명을 표시합니다
        function displayInfowindow(marker, title) {
            var content = '<div style="padding:5px;z-index:1;">' + title + '</div>';

            infowindow.setContent(content);
            infowindow.open(map, marker);
        }

        // 검색결과 목록의 자식 Element를 제거하는 함수입니다
        function removeAllChildNods(el) {
            while (el.hasChildNodes()) {
                el.removeChild(el.lastChild);
            }
        }
    </script>
    <footer class="fixed-bottom  text-center text-light p-3">Copyright by 이서린</footer>

</body>

</html>