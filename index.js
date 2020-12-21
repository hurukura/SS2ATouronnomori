const TRANSITION_END = 'transitionend';

firebase.initializeApp({databaseURL: "https://s192003auth.firebaseio.com/"});

let database = firebase.database(); //firebase初期化
let refCount = database.ref('count');
let $post = $('.js-post');
let $count = $('.js-count');
let countObj = {
  'sansei': 0,
  'hantai': 0;
};
let countStop = false;
let $layer = $('.js-layer');
let $layerLoading = $('.js-layer-loading');

/*
 * View
 * ・カウント表示
 */
let defRenderCount = (countObj) => {
  let $targetCountObj = $(`.js-count-${countObj.id}`);

  $targetCountObj.text(countObj.value);
};

let renderCount = (countObj) => {
  for (let key in countObj){
    if(parseInt($(`.js-count-${key}`).text(), 10) !== countObj[key]) {
      let $targetCountObj = $(`.js-count-${key}`);
      let $targetCountObjPost = $targetCountObj.closest('.js-post');

      $targetCountObj.text(countObj[key]);
    }
  }
};

let postActionCount = (initial, countVal) => {
  let arg = {};
  arg[initial] = countVal;
  show();
  refCount.update(arg).then((res)=>{
    setTimeout(() => {
      hide();
    }, 300);
  });
};

/*
 * クリックイベント
 * ・ボタンクリック
 * ・初期読み込み
 * ・pushイベント検知
 */
$post.on('click', (e) => {
  if (countStop) {
    return;
  }
  let initial = $(e.currentTarget).data('initial');
  countObj[initial] = countObj[initial] + 1;
  postActionCount(initial, countObj[initial]);
});

refCount.on("child_added", (snapshot) => {
  // データベースと同期
  countObj[snapshot.key] = snapshot.val();

  defRenderCount({
    id: snapshot.key,
    value: snapshot.val()
  });
});

refCount.on("value", (snapshot) => {
  let snapshotObj = snapshot.val();

  // データベースと同期
  for (let key in snapshotObj){
    countObj[key] = snapshotObj[key];
  }

  renderCount(snapshot.val());
});

/*
 * その他
 */
let show = () => {
  $layer.removeClass('dn');
  $layerLoading.removeClass('dn');
  $layer.addClass('is-show');
};

let hide = () => {
  $layer.removeClass('is-show').one(TRANSITION_END, () => {
    $layerLoading.addClass('dn');
    $layer.addClass('dn');
  });
};