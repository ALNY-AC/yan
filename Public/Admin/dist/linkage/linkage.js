// @ts-nocheck
//联动下拉菜单


function linkage(arr, form, active) {


    for (var i = 0; i < arr[0].length; i++) {
        var item = arr[0][i];
        var selected = item.nav_id == active[0] ? 'selected' : '';
        $('#l1').append('<option value="' + item.nav_id + '"' + selected + '>' + item.nav_title + '</option>');
    }


    //如果有默认二级菜单
    if (active[1]) {
        $('#l2').empty();

        for (var i = 0; i < arr[1].length; i++) {
            var item = arr[1][i];
            if (item.super == active[0]) {
                var selected = item.nav_title == active[1] ? 'selected' : '';

                $('#l2').append('<option value="' + item.nav_id + '"' + selected + '>' + item.nav_title + '</option>');
            }
        }

    }

    form.render('select'); //刷新select选择框渲染


}



// var linkage = function (arr, form, brand_id, class1_id, class2_id) {


//     w(arr);
//     return;

//     for (var i = 0; i < arr[0].length; i++) {
//         var item = arr[0][i];
//         var selected = (item.brand_id == brand_id ? 'selected ="selected "' : '')
//         $('#se_brand').append('<option value="' + item.brand_id + '"' + selected + '>' + item.brand_nav_title + '</option>');
//     }

//     if (brand_id != null) {

//         var super_id;

//         for (var i = 0; i < arr[1].length; i++) {
//             var item = arr[1][i];
//             if (item.brand_id == brand_id) {
//                 var selected = (item.class_id == class1_id ? 'selected ="selected "' : '')
//                 if (item.class_id == class1_id) {
//                     super_id = item.class_id;
//                 }
//                 $('#se_class_1').append('<option value="' + item.class_id + '"' + selected + '>' + item.class_nav_title + '</option>');
//             }
//         }

//         for (var i = 0; i < arr[2].length; i++) {
//             var item = arr[2][i];
//             if (item.super_id == super_id) {
//                 var selected = (item.class_id == class2_id ? 'selected ="selected "' : '')
//                 w(item.class_id);
//                 $('#se_class_2').append('<option value="' + item.class_id + '"' + selected + '>' + item.class_nav_title + '</option>');
//             }
//         }

//     }


//     form.on('select(' + 'se_brand' + ')', function (data) {
//         //获得一级id
//         var id = data.value;
//         //清空一级class元素
//         $('#se_class_1').empty();
//         //遍历插入
//         for (var i = 0; i < arr[1].length; i++) {
//             var item = arr[1][i];
//             if (item.brand_id == id) {
//                 $('#se_class_1').append('<option value="' + item.class_id + '">' + item.class_nav_title + '</option>');
//             }
//         }

//         form.render('select'); //刷新select选择框渲染

//     });


//     form.on('select(' + 'se_class_1' + ')', function (data) {
//         //获得一级id
//         var id = data.value;
//         //清空一级class元素
//         $('#se_class_2').empty();
//         //遍历插入
//         for (var i = 0; i < arr[2].length; i++) {
//             var item = arr[2][i];
//             if (item.super_id == id) {
//                 $('#se_class_2').append('<option value="' + item.class_id + '">' + item.class_nav_title + '</option>');
//             }
//         }

//         form.render('select'); //刷新select选择框渲染

//     });

//     form.render('select'); //刷新select选择框渲染

// }