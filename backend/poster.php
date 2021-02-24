<div class="rb tab">
    <h2 class="ct">預告片清單</h2>
    <div style="width: 100%;display:flex" class="ct">
        <div style="width:25%;background:#999">預告片管理</div>
        <div style="width:25%;background:#999">預告片片名</div>
        <div style="width:25%;background:#999">預告片排序</div>
        <div style="width:25%;background:#999">操作</div>
    </div>
    <form action="api/edit_poster.php" method="post">
        <div style="width: 100%;height:200px;overflow-y:scroll">
            <?php
            $posters = $Poster->all(" order by rank");
            foreach ($posters as $key => $poster) {
            ?>

                <div style="width: 100%;display:flex" class="ct">
                    <div style="width: 25%;">
                        <img src="img/<?= $poster['img']; ?>" style="width:80px" alt="">
                    </div>
                    <div style="width:25%;">
                        <input type="text" name="name[]" value="<?= $poster['name']; ?>">
                    </div>
                    <div style="width:25%;">
                        <input type="text" name="rank[]" value="<?= $poster['rank'] ?>">
                    </div>
                    <div style="width:25%;">
                        <input type="checkbox" name="sh[]" value="<?= $poster['id']; ?>" <?= ($poster['sh'] == 1) ? 'checked' : ''; ?>>顯示
                        <input type="checkbox" name="del[]" value="<?= $poster['id']; ?>">刪除
                        <select name="ani[]">
                            <option value="1" <?= ($poster['ani'] == 1) ? "selected" : ''; ?>>淡入淡出</option>
                            <option value="2" <?= ($poster['ani'] == 2) ? "selected" : ''; ?>>滑入滑出</option>
                            <option value="3" <?= ($poster['ani'] == 3) ? "selected" : ''; ?>>縮放</option>
                        </select>
                        <input type="hidden" name="id[]" value="<?=$poster['id'];?>">
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="ct">
            <input type="submit" value="編輯確定">
            <input type="reset" value="重置">
        </div>
    </form>
    <form action="api/add_poster.php" method="post" enctype="multipart/form-data">
        <table style="margin: auto;">
            <tr>
                <td>預告片海報</td>
                <td><input type="file" name="img" id=""></td>
                <td>預告片片名</td>
                <td><input type="text" name="name" id=""></td>
            </tr>
        </table>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</div>