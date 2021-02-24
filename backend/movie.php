<div class="rb tab">
    <a href="admin.php?do=add_movie">
        <button>新增電影</button>
    </a>
    <hr>
    <div style="height: 400px;overflow-y:auto">
        <?php
        $movies = $Movie->all(" order by rank");
        foreach ($movies as $key => $movie) {
        ?>

            <div style="display: flex;color:black;background:white;margin:5px 0px">
                <div style="width: 20%;">
                    <img src="img/<?= $movie['poster']; ?>" style="width: 80px;" alt="">
                </div>
                <div>
                    分級: <img src="icon/<?= $movie['level']; ?>.png" alt="">
                </div>
                <div style="width: 60%;">
                    <div style="display:flex">
                        <div style="width: 33%;">片名:<?= $movie['name']; ?></div>
                        <div style="width: 33%;">片長:<?= $movie['length']; ?></div>
                        <div style="width: 33%;">上映日期:<?= $movie['ondate']; ?></div>
                    </div>
                    <div style="text-align: right;">
                        <a href="admin.php?do=edit_movie&id=<?= $movie['id']; ?>"><button>編輯電影</button></a>
                        <button onclick="del(<?= $movie['id']; ?>)">刪除電影</button>
                        <?php
                        if ($key != 0) {
                        ?>
                            <button onclick="sw(<?= $movie['id']; ?>,<?= $movies[$key - 1]['id']; ?>)">往上</button>
                        <?php
                        }
                        if ($key != (count($movies) - 1)) {
                        ?>
                            <button onclick="sw(<?= $movie['id']; ?>,<?= $movies[$key + 1]['id']; ?>)">往下</button>
                        <?php
                        }
                        ?>
                    </div>
                    <div>
                        電影介紹:
                        <?= $movie['intro']; ?>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>
    </div>
</div>
<script>
    function sw(x, y) {
        $.post('api/sw.php', {
            table: 'movie',
            x,
            y
        }, () => {
            location.reload()
        })
    }

    function del(id) {
        $.post("api/del_movie.php", {
            table: 'movie',
            id
        }, () => {
            location.reload();
        })
    }

    function display(id) {
        $.post('api/display.php', {
            table: 'movie',
            id
        }, () => {
            // location.reload();
        })
    }
</script>