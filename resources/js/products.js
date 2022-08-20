const { get } = require("jquery")

//検索非同期化
$("#serch-btn").on('submit', function() {

    $.ajax({
        type: 'GET',
        url: '/products',
        data: $('.serch').serialize(),
        dataType: 'json'

    })
})

//削除ボタン非同期化
$(".del-btn").on('submit',function() {

    let clickEle = $(this);
    let delId = clickEle.attr('del-id');

    $.ajax({
        type: 'POST',
        url: '/products.delete/{id}',
        data: {'id': delId,
                '_method': 'DELETE'}

    })
} )