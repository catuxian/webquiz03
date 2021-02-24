<style>
  .posters {
    width: 200px;
    height: 260px;
    margin: auto;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .posters>div {
    position: absolute;
    width: 100%;
    height: 100%;
  }

  .posters img {
    width: 100%;
  }

  .arrow {
    width: 0;
    height: 0;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
  }

  .arrow.left {
    border-right: 20px solid green;
  }

  .arrow.right {
    border-left: 20px solid green;
  }

  .buttons {
    display: flex;
    width: 400px;
    justify-content: center;
    align-items: center;
    margin: auto;
  }

  .list {
    display: flex;
    width: 320px;
    overflow: hidden;
  }

  .btn {
    margin: 5px;
  }

  .btn img {
    width: 70px;
  }
</style>

<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
    <div class="posters">
      <?php
      $posters = $Poster->all(['sh' => 1], " order by rank");
      foreach ($posters as $key => $poster) {
        echo "<div class='po' id='p{$key}' data-ani='{$poster['ani']}'>";
        echo "<img src='img/{$poster['img']}'>";
        echo "<span>{$poster['name']}</span>";
        echo "</div>";
      }
      ?>
    </div>
    <div class="buttons">
      <div class="arrow left"></div>
      <div class="list">
        <?php

        foreach ($posters as $key => $poster) {
          echo "<div class='btn' id='b{$key}' data-ani='{$poster['ani']}'>";
          echo "<img src='img/{$poster['img']}'>";
          echo "<span style='display:block'>{$poster['name']}</span>";
          echo "</div>";
        }

        ?>
      </div>
      <div class="arrow right"></div>
    </div>
  </div>
  <script>
    let p = 0;
    let pos = $(".po").length; //總長度
    $(".arrow").on("click", function() {
      if ($(this).hasClass("right")) { //右邊
        if ((p + 1) <= (pos - 4)) {
          p++;
        }
      } else { //左邊
        if ((p - 1) >= 0) {
          p--
        }
      }
      $(".btn").hide();
      for (let i = p; i < p + 4; i++) {
        $("#b" + i).show()
      }
    })

    $(".po").hide()
    $("#p0").show()

    t = setInterval('ani()', 2500)

    function ani(next) {
      //取得轉場效果
      let now = $(".po:visible");
      let ani = $(now).data('ani');

      if (next == undefined) {
        if ($(now).next().length == 1) { //若下一張圖片存在
          next = $(now).next()
          // console.log(now.next().length)
        } else {

          //如果沒有下一張海報,則取得第一張海報
          next = $("#p0")
        }
      }

      switch (ani) {
        case 1:
          //淡入淡出
          $(now).fadeOut(1000)
          $(next).fadeIn(1000)
          break;
        case 2:
          //滑入滑出
          $(now).slideUp(1000, function() {
            $(next).slideDown(1000)
          })
          break;
        case 3:
          //縮放
          $(now).hide(1000)
          $(next).show(1000)
          break;

      }
    }
    //按鈕事件，切換海報並有轉場效果
    $(".btn").on("click", function() {
      // console.log(this)
      let id = $(this).attr('id').replace("b", "p");

      ani($("#" + id));

    })
    $(".buttons").hover(
      function() {
        clearInterval(t)
      },
      function() {
        t = setInterval('ani()', 2500)
      }
    )
  </script>
</div>
<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap">
    <?php
    $today = date("Y-m-d");
    $startDate = date("Y-m-d", strtotime("-2 days"));

    $total = $Movie->count(['sh' => 1], " && `ondate` between '$startDate' and '$today'");
    $div = 4;
    $pages = ceil($total / $div);
    $now = isset($_GET['p']) ? $_GET['p'] : 1;
    $start = ($now - 1) * $div;

    $movies = $Movie->all(['sh' => 1], " && `ondate` between '$startDate' and '$today' order by rank limit $start,$div");
    foreach ($movies as $movie) {
    ?>
      <div style="width: 45%;">
        <div>片名:<?= $movie['name']; ?></div>
        <div style="display: flex;">
          <img src="img/<?= $movie['poster']; ?>" style="width: 50%;" alt="">
          <div>
            <img src="icon/<?= $movie['level']; ?>.png" alt=""><?= $movie['level']; ?><br>
            上映日期:<?= $movie['ondate']; ?>
          </div>
        </div>
        <div>
          <a href="index.php?do=intro&id=<?= $movie['id']; ?>"><button>劇情簡介</button></a>
          <a href="index.php?do=ord&id=<?= $movie['id']; ?>"><button>線上訂票</button></a>
        </div>
      </div>
    <?php
    }
    ?>
    
  </div>
  <div class="ct">
      <?php
      if (($now - 1) > 0) {
      ?>
        <a href="?p=<?=$now-1;?>"><</a>
      <?php
      }
      for($i=1;$i<=$pages;$i++){
      ?>
      <a href="?p=<?=$i;?>"><?=$i;?></a>
      <?php
        }
      if(($now+1)<=$pages){
      ?>
      <a href="?p=<?=$now+1;?>">></a>
      <?php
        }
      ?>
    </div>
</div>