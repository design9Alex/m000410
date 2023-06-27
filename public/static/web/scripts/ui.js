$(document).ready(function(){
    AOS.init();
    var nWindowWidth = window.innerWidth;

    $(window).on('resize',function(){
        let nNowWindowWidth = window.innerWidth;
        if(nNowWindowWidth !== nWindowWidth){
            
            if((nNowWindowWidth > 1199 && nWindowWidth < 1200)){
                location.reload();
            }
            else if((nNowWindowWidth < 1200 && nWindowWidth > 1199)){
                location.reload();
            }
        }

        nWindowWidth = nNowWindowWidth;
    });

    if(nWindowWidth > 1199){
        $(window).on('load',function(){
            if($('.jsMenuSub').css('display') === 'block'){
                $('.jsHeader').addClass('fixed hover');
                $('.jsHeaderBg').addClass('active');
            }
        });
    }

    $(window).on('load scroll',function(){
        if(!$('.jsMenuBox').hasClass('active')){
            nScroll = $(window).scrollTop();
            if(nScroll > 30 ){
                $('.jsHeader').addClass('fixed');
            }
            else{
                if(!$('.jsHeader').hasClass('hover')){
                    $('.jsHeader').removeClass('fixed');
                }                
            }
            if(nScroll > 400 ){
                $('.jsGoTop').addClass('active');
            }
            else{
                $('.jsGoTop').removeClass('active');
            }
        }
    });

    $('.jsGoTop').on('click' , function(){
        $('html').animate({scrollTop:0}, 500);
    });

    $('.jsCookiesBtn').on('click' , function(){
        $('.jsCookiesBox').addClass('active');
    });

    $('.jsMenuBtn').on('click' , function(){        
        if(!$('.jsHeader').hasClass('active')){
            $('.jsMenuBox').slideDown();
            $('html').css('overflow-y','hidden');
            $('.jsHeader').addClass('active');
        }
        else{
            $('.jsMenuBox').slideUp();
            $('html').css('overflow-y','auto');
            setTimeout(function(){
                $('.jsHeader').removeClass('active');
            },500); 
        }
    });

    if(nWindowWidth > 1199){        
        $('.jsMenuTopic').on('mouseover',function(){
            $('.jsHeader').addClass('fixed hover');
            $('.jsHeaderBg').addClass('active');
            $('.jsHeaderSearchBox').removeClass('active child');
            $('.jsHeader').removeClass('search');
        });

        $('.jsMenuTopic').on('mouseout',function(){
            if($(window).scrollTop() > 30){
                $('.jsHeader').removeClass('hover');
            }
            else{
                $('.jsHeader').removeClass('fixed hover');
            }        
            $('.jsHeaderBg').removeClass('active');
        });

        $('.jsMenuSub').on('mouseover',function(){
            $('.jsHeader').addClass('fixed hover');
            $(this).siblings('.jsMenuTopic').addClass('hover');
            $('.jsHeaderBg').addClass('active');
        });

        $('.jsMenuSub').on('mouseout',function(){
            if($(window).scrollTop() > 30){
                $('.jsHeader').removeClass('hover');
            }
            else{
                $('.jsHeader').removeClass('fixed hover');
            }
            $(this).siblings('.jsMenuTopic').removeClass('hover');
            $('.jsHeaderBg').removeClass('active');
        });
    }
    else{
        $('.jsHeader').removeClass('hover');
        $('.jsMenuBlock:not(.jsMenuSubOther)').on('click', function(){
            if($(this).hasClass('active')){
                $(this).find('.jsMenuSub').slideUp();
                $(this).removeClass('active');
                
            }else{
                $(this).find('.jsMenuSub').slideDown();
                $(this).addClass('active');
            }

            if($(this).hasClass('default')){                
                setTimeout(function(){
                    $('.jsMenuBlock').removeClass('default');
                },400);
            }
        });

        $('.jsMenuSubOther').on('click' , function(){
            let sHref = $(this).find('.jsMenuSubHref').eq(0).attr('href');
            if($(this).find('.jsMenuSubHref').eq(0).attr('target') === 'blank'){
                window.open(sHref, '_blank');
            }
            else{
                location.href=sHref;
            }            
        });
    }

    $('.jsHeaderSearchBtn').on('click' , function(){
        $('.jsHeaderSearchBox,.jsHeaderBg').addClass('active');
        setTimeout(function(){
            $('.jsHeaderSearchBox').addClass('child');
        },100);        
        $('.jsHeader').addClass('search');
    });

    $('.headerSearchBtnClose').on('click' , function(){
        $('.jsHeaderSearchBox').removeClass('child');
        setTimeout(function(){
            $('.jsHeaderSearchBox,.jsHeaderBg').removeClass('active');
            $('.jsHeader').removeClass('search');
        },500);
    });

    $('.jsFilterSel').on('click' , function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(this).find('.FilterSelManu').slideDown();
        }else{
            $(this).find('.FilterSelManu').slideUp();
        }
    });

    $('.jsFilterMenuBtn').on('click' , function(){
        let nKind = $(this).attr('data-value');
        let sText = $(this).text();
        let sName = $(this).closest('.jsFilterSel').attr('data-select');
        $(this).closest('.jsFilterSel').find('.jsFilterSelVewText').text(sText);
        if(sName !== undefined){
            $('input[name="'+sName+'"]').val(nKind);
        }
    });

    $('input[type="tel"]').on('keyup',function(){
        let sReg = new RegExp(/[0-9]/);
        let sVal = $(this).val();
        let nLength = $(this).val().length;
        let sLast = $(this).val().substr(-1);
        if(!sReg.test(sLast) && sLast != '-' && sLast != '#'){
            $(this).val(sVal.substr(0,(nLength-1)));
        }
    });

    $('.jsTabNow').on('click' , function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(this).siblings('.jsTabMenu').slideDown();
        }
        else{
            $(this).siblings('.jsTabMenu').slideUp();
        }
    });

    if($('.jsIdxBox').length > 0){
        $('.jsIdxCarouselBox').owlCarousel({
            autoplay:true,
            autoplayTimeout:10000,
            items:1,
            loop:true,
            center:true,
            dots:true,
        });

        var nIdxCarouselCount = 0;
        $('.jsIdxCarouselBox .owl-item:not(.cloned)').each(function(i,item){
            let sTitle = $(item).find('.jsIdxCarouselTitle').text();

            $('.jsIdxCarouselBox .owl-dots').find('.owl-dot').eq(nIdxCarouselCount).find('span').text(sTitle);

            nIdxCarouselCount ++;
        });

        $('.jsIdxCarouselBox .owl-dot').append('<div class="idxCarouseDotDecro"></div>');
        $('.jsIdxCarouselBox .owl-dot').attr('aria-label','button');

        $('.jsIdxNewsCarousel').owlCarousel({
            items:1,
            margin:3,
            loop:true,
            nav:true,
            center:true,
            dots:false,
            responsive:{
                768:{
                    center:false,
                    items:1.5,
                    margin:35,
                },
                820:{
                    center:false,
                    items:1.8,
                    margin:35,
                },
                930:{
                    center:false,
                    items:2.3,
                    margin:35,
                },
                1200:{
                    center:false,
                    items:2.7,
                    margin:35,
                },
                1400:{
                    center:false,
                    items:3.7,
                    margin:25,
                },
                1500:{
                    center:false,
                    items:3.7,
                    margin:45,
                }
            },
        });

        $('.jsIdxNewsCarousel').find('.owl-prev').html('<i class="icon_arrowL0"></i>');
        $('.jsIdxNewsCarousel').find('.owl-next').html('<i class="icon_arrowR0"></i>');
        $('.jsIdxNewsCarousel .owl-nav button').attr('aria-label','button');

        $('.jsIdxTopicNav').on('click',function(){
            let sDirect = $(this).attr('data-nav');
            if(sDirect === 'prev'){
                $('.jsIdxNewsCarousel .owl-prev').click();             
            }
            else if(sDirect === 'next'){
                $('.jsIdxNewsCarousel .owl-next').click();
            }
        });

        particlesJS.load('particles-js', 'scripts/plugins/particles.json', function() {});

        AOS.refresh();
    }
	
    if($('.jsHistoryBox').length > 0){
        historyYear();
        $(window).on('load scroll resize',function(){
            historyYear();
        });

        $(window).on("load scroll", function() {
            nStandard = $(this).scrollTop() + ($(this).height() / 1.8),
            oItem = new Array,
            $('.jsHistoryYearBlock').each(function(index){
                oItem.push($(this).offset().top);
                if (nStandard >= oItem[index]) {
                    $(this).addClass("active");
                }else{
                    $(this).removeClass("active");
                }
            });   
        });

        $('.jsHistoryYear').on('click',function(){
            let nYear = $(this).attr('data-year');
            let nScrollTop = $('.jsHistoryYearBlock[data-year="'+nYear+'"]').offset().top - 100;
            $('html,body').stop().animate({scrollTop:nScrollTop},700);
        });
    }

    if($('.jsProductdtlBox').length > 0){
        var nProductdtlIndex = 0;

        $('.jsProductdtlCarouselPic').on('click',function(){
            let sSRC = $(this).find('img').attr('src');
            $('.jsProductdtlMainPic').attr('src',sSRC);
            $('.jsProductdtlCarouselPic').removeClass('active');
            $(this).addClass('active');
            nProductdtlIndex = $(this).index();
        });

        $('.jsProductdtlCarouselBtn').on('click',function(){
            let nTotal = $('.jsProductdtlCarouselPic').length;
            let nKind = parseInt($(this).attr('data-kind'));

            $('.jsProductdtlCarouselPic').removeClass('active');

            if(nKind > 0 && nProductdtlIndex < (nTotal-1)){
                nProductdtlIndex ++;
            }else if(nKind < 0 && nProductdtlIndex > 0){
                nProductdtlIndex --;
            }
            $('.jsProductdtlCarouselPic').eq(nProductdtlIndex).addClass('active');

            if(nProductdtlIndex > 2){
                $('.jsProductdtlCarousel').animate({scrollTop:120*(nProductdtlIndex-1)}, 333);
            }else{
                $('.jsProductdtlCarousel').animate({scrollTop:0}, 333);
            }

            let sSRC = $('.jsProductdtlCarouselPic.active').find('img').attr('src');
            $('.jsProductdtlMainPic').attr('src',sSRC);

            $('.jsProductdtlCarouselBtn').removeClass('disabled');
            if(nProductdtlIndex == 0){
                $('.jsProductdtlCarouselBtn[data-kind="-1"]').addClass('disabled');
            }else if(nProductdtlIndex == (nTotal-1)){
                $('.jsProductdtlCarouselBtn[data-kind="1"]').addClass('disabled');
            }
        });
    
        $(".jsBriefInfo").mCustomScrollbar({
            theme:"inset-3",
            mouseWheel:{
                enable:true,
                preventDefault:true,
            },
            setHeight:140,        
        });

        $('.jsProductdtlTab').on('click',function(){
            let nNo = $(this).attr('data-no');
            $('.jsProductdtlTab,.jsProductdtlIntroCont').removeClass('active');
            $(this).addClass('active');
            $('.jsProductdtlIntroCont[data-no="'+nNo+'"]').addClass('active');
        });
    }

    if($('.jsShareholderBox').length > 0){
        $('.jsShareholderTab').on('click',function(e){
            e.preventDefault();
            let sHref = $(this).attr('href');
            $('.jsShareholderPop').addClass('active default');
            $('.jsPopLink').attr('href',sHref);
        });

        $('.jsPopLink,.jsPopCancel').on('click',function(){
            $('.jsShareholderPop').removeClass('active');
        });
    }

    if($('.jsContactBox').length > 0 || $('.jsStaffloginBox').length > 0){
        $('select').niceSelect();        
    }

    $('.nice-select').on('click',function(e){
        if($(this).hasClass('open')){
            $(this).find('.list').slideUp();
        }else{
            $(this).find('.list').slideDown();
        }
    });

    if($('.jsFnclrptBox').length > 0){
        let aHide = [];
        let sTime = $('.jsFnclrptChart').attr('data-when');
        let sKind = $('.jsFnclrptChart').attr('data-kind');

        if(sTime !== undefined && sKind !== undefined){
            chartData(aHide,sKind,sTime);
        }

        $('.jsFnclrptYearLabel').on('click',function(){
            if($(this).siblings('input').is(":checked")){
                $(this).siblings('input').prop('checked',false);
            }else{
                $(this).siblings('input').prop('checked',true);
            }
        });

        $('.jsFnclrptYear').on('click',function(){
            timeSelect(aHide=[]);
            window.chartGraph.destroy();
            chartData(aHide,sKind,sTime);
            $('.jsFnclrptTh,.jsFnclrptTd').show();
            for(let i in aHide){
                $('.jsFnclrptTh[data-year="'+aHide[i]+'"]').hide();
                $('.jsFnclrptTd[data-year="'+aHide[i]+'"]').hide();
            }
        });

        $('.jsFnclrptKindActBtn').on('click',function(){
            let sDirect = $(this).attr('data-act');
            let nScroll = $('.jsFnclrptKindInner').scrollLeft();
            let nGo;
            if(sDirect === 'prev'){
                nGo = nScroll-300;
            }
            else if(sDirect === 'next'){
                nGo = nScroll+300;
            }
            $('.jsFnclrptKindInner').animate({scrollLeft:nGo}, 200);
        });
    }
});

function timeSelect(aHide){
    $.each($('.jsFnclrptYear'),function(index,year){
        if(!$(year).find('input').is(":checked")){
            aHide.push($(year).find('.jsFnclrptYearLabel').text());
        }
    });
}

function chartData(aHide,sKind,sTime){
    $.getJSON('scripts/default/financialData.json',function(json){
        let aLabels = [];
        let aTmpData = [];
        let aDatasets = [];
        let aScales = {};
        let data = json[sKind];
        if(sTime in data){
            for(let year in data[sTime]){
                if(aHide.length > 0 && aHide.includes(year)){
                    continue;
                }

                // 損益表
                if(sKind == 'income_statement'){
                    if(year == 'QoQ' || year == 'YoY'){
                        continue;
                    }
                }

                aLabels.push(year);                
                aTmpData[year] = [];
                for(let item in data[sTime][year]){

                    // 資產負債表
                    if(sKind == 'balance_sheet'){
                        if(item == 'netincome10' || item == 'netincome1'){
                            continue;
                        }
                    }

                    aTmpData[year][item] = data[sTime][year][item];
                }
            }

            var aTmpChartData = [];
            for(let index in data.title[sTime]){
                // 資產負債表
                if(sKind == 'balance_sheet'){
                    if(data.title[sTime][index].key == 'netincome10' || data.title[sTime][index].key == 'netincome1'){
                        continue;
                    }
                }
                aTmpChartData[data.title[sTime][index].key] = [];                    
                for(let year in aTmpData){
                    let sNnum = aTmpData[year][data.title[sTime][index].key];
                    sNnum = sNnum.replace(/[,]/g,'')
                    sNnum = sNnum.replace(/[%]/g,'')
                    let nNum = Number(sNnum.replace(/[,]/g,''));
                    aTmpChartData[data.title[sTime][index].key].push(nNum);
                }

                if(data.title[sTime][index].type === 'bar'){
                    var oTmpDatasets = {
                        "type" : data.title[sTime][index].type,
                        "label" : data.title[sTime][index].label,
                        "data" : aTmpChartData[data.title[sTime][index].key],
                        "borderRadius" : data.title[sTime][index].borderRadius,
                        "yAxisID" : data.title[sTime][index].yAxisID,
                        "maxBarThickness" : data.title[sTime][index].maxBarThickness,
                        "categoryPercentage" : data.title[sTime][index].categoryPercentage,
                        "backgroundColor" : data.title[sTime][index].backgroundColor
                    };
                }
                else if(data.title[sTime][index].type === 'line'){
                    var oTmpDatasets = {
                        "type" : data.title[sTime][index].type,
                        "label" : data.title[sTime][index].label,
                        "data" : aTmpChartData[data.title[sTime][index].key],
                        "fill": false,
                        "pointBorderWidth" : data.title[sTime][index].pointBorderWidth,
                        "yAxisID" : data.title[sTime][index].yAxisID,
                        "tension" : data.title[sTime][index].tension,
                        "borderColor" : data.title[sTime][index].borderColor,
                        "backgroundColor" : data.title[sTime][index].backgroundColor
                    };
                }
                aDatasets.push(oTmpDatasets);                
            }
        }

        aScales = data.scales[sTime];
        
        chartRedraw(aLabels,aDatasets,aScales);
    });
}

function chartRedraw(aLabels,aDatasets,aScales){
    var ctx = document.getElementById('jsFnclrptChartGraph').getContext("2d");
    const data = {
        labels: aLabels,
        datasets:aDatasets
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,                    
            scales: aScales,
            plugins:{                      
                legend:{
                    position:'bottom',
                    align:'start',
                    labels:{
                        boxWidth:14,
                        boxHeight:14,
                        useBorderRadius:true,
                        borderRadius:3,
                        padding:30 ,
                        color:'#000000',
                        font:{
                            family:"'Noto Sans TC'",
                            weight:400,
                            size:15,
                        }
                    }
                },
                tooltip:{
                    backgroundColor:'rgba(0,0,0,.7)',
                    titleFont:{
                        family:"'Roboto'",
                        weight:500,
                        size:14,
                    }
                }
            },
        }
    };

    window.chartGraph = new Chart(ctx, config);
}

function historyYear(){
    let nScrollTop = $(document).scrollTop();
    $('.jsHistoryYearBlock').each(function(){
        let nHopeTop = $(this).offset().top - 470;
        let nFinalTop = nHopeTop + $(this).height();
        if (nHopeTop <= nScrollTop && nScrollTop <= nFinalTop){
            let nKind = $(this).data('kind');
            if(nKind > 0)
            {
                $('.jsHistoryYear').removeClass('active');
                $('.jsHistoryYear[data-year="'+ nKind +'"]').addClass('active');
            }
        }
    });  
}