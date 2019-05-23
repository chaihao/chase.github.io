 <?php 
 
 class generateDateCode{

    // 生成唯一订单编号
    public function generate($data){
        $date = date('ymd', time());
        // 自定义拼接符前缀
        $prefix = $data['prefix'] ? $data['prefix'] : 'CD'; 
        //格式： 前缀+年月日+数量
        $domain = $data['domain'] ? $data['domain'] : 'custom';
        $key = $domain.'_num_sequence';
        // key 中的域 field 
        $code = $data['code'] ? $data['code'] : 'code';
        $field =  $code . $date;
        
        $id = Yii::$app->redis->hincrby($key, $field, 1);
        // 数值长度
        $length = $data['code'] ? $data['code'] : '10';
        //不足的补零
        $number = str_pad($id, $length, "0", STR_PAD_LEFT);
        // 生成唯一值
        $serialNumber = $prefix . $date . $number;

        return $serialNumber;
    }
 
}



 
 ?>
 