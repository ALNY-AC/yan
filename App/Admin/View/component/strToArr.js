
/**
 * 创建时间：2017年9月15日 18:31:36
 * 修改时间：2017年9月15日 18:31:36
 * ===========================================
 * 作者：代码狮
 * ===========================================
 * QQ：1173197065
 * 微信：ajs0314
 * GitHub：https://github.com/ALNY-AC
 * ===========================================
 * 如发现有bug，请速联系作者。
 * 后来者不懂的地方，请联系作者。
 * ===========================================
 * 因为客户浏览器不统一，所以不实用es6语法
 * ===========================================
 * @author 代码狮
 * @param str string 必须，要转换的字符串，比如：1,2,3 或者1 2 3 或者 1|2|3|，分隔符自定。
 * @param code string 必须，要当做分隔符的字符串，自定。
 * @param f function|string 必须，当为string的时候，为指定键名，当为function的时候，则为调用函数
 */
function strToArr(str, code, f) {

    // 将字符串按照code分割成数组
    var array = str.split(code);
    // 创建一个空数组，用于返回
    var arr = [];

    // 开始str分割后的数组
    for (var i = 0; i < array.length; i++) {
        // 获得每个元素
        var item = array[i];
        // 当f函数 不为空的时候
        if (f != null) {

            // 判断是不是字符串
            if (typeof (f) == 'string') {
                //如果是字符串
                arr[i] = {};        //创建一个json
                arr[i][f] = item;   //让f当做键名，直接将item赋值给他
            }
            //判断是不是函数
            if (typeof (f) == 'function') {
                //当f为function的时候
                //调用这个函数，并且传值进去
                /**
                //  * @param i int 当前循环的索引值
                //  * @param arr array 当前的这个数组
                //  * @param item string str分割后的数组的元素
                 */
                arr[i] = f(i, arr, item);
            }


        } else {
            arr[i] = item;
        }
    }
    return arr;

}

var obj = ['孙辉', '孙晓东', '王圣亚', '余双兵']


var arr = strToArr('1,2,3,4', ',', function (i, arr, item) {
    var _json = {};
    _json.id = item;
    _json.name = obj[i];
    return _json;
});
console.log(arr);
console.log('==========================');
arr = strToArr('1,2,3,4', ',', 'id');
console.log(arr);
