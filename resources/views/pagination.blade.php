@php

$lastPage=$listData->lastPage();
$totalPages=ceil($listData->total()/$listData->perPage());

$prevPage=$listData->currentPage()-1;
if($prevPage<1){
    $prevPage=1;   
}
$nextPage=$listData->currentPage()+1;
if($nextPage>$lastPage){
    $nextPage=$lastPage;
}



@endphp
<nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center mt-2">
                                                <li class="page-item previous "><a class="page-link" href="{{route($paginationRoute, ['page'=>$prevPage])}}">
                                                        <i class="bx bx-chevron-left"></i>
                                                    </a></li>

                                                 @for($i=1;$i<=$lastPage;$i++)
                                                        <li class="page-item {{ $listData->currentPage()==$i? 'active' :'' }}" aria-current="page"><a class="page-link" href="{{route($paginationRoute, ['page'=>$i])}}">{{$i}}</a></li>
                                                 @endfor
                                                


                                                <li class="page-item next"><a class="page-link" href="{{route($paginationRoute, ['page'=>$nextPage])}}">
                                                        <i class="bx bx-chevron-right"></i>
                                                    </a></li>
                                            </ul>
                                        </nav>

