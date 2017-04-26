<p>請確認您的器材借用申請表已下載</p>
<p>Please make sure that the device application has been downloaded</p>

<a href="javascript:history.back(-2)">返回借用紀錄</a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.27/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vfs_font.js"></script>
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<script>

pdfMake.fonts = {
  "kaiu": {
    normal: "kaiu.ttf"
  }
};

var docDefinition = {
  content: [
    { text: "器材借用提領單", fontSize: 20, margin: [10, 3], alignment: 'center' },
    { text: "Device Leasing Check List", fontSize: 16, margin: [5, 10], alignment: 'center' },
    { text: '【 借用申請資訊 Application Info 】', fontSize: 16, margin: [10, 5] },
    { text: "借用日期：<?php echo $device_apply['date']; ?>", fontSize: 14, margin: [10, 5] },
    { text: "預計歸還日期：<?php echo $device_apply['end_date']; ?>", fontSize: 14, margin: [10, 5] },
    { text: "借用單位：<?php echo $device_apply['organization']; ?>", fontSize: 14, margin: [10, 5] },
    { text: "借用申請人：<?php echo $device_apply['applicant']; ?> (<?php echo $device_apply['applicantPosition']; ?>)", fontSize: 14, margin: [10, 5] },
    { text: "聯絡電話：<?php echo $device_apply['phone']; ?>", fontSize: 14, margin: [10, 5] },
    { text: "借用目的：<?php echo $device_apply['purpose']; ?>", fontSize: 14, margin: [10, 5] },
    { text: "", margin: [10, 3] },
    { text: '【 借用核對資訊 Check Info 】', fontSize: 16, margin: [10, 5] },
    { text: "出借日期：       月    日", fontSize: 14, margin: [10, 5]},
    { text: "出借人員簽名：           ", fontSize: 14, margin: [10, 5]},
    { text: "實際歸還日期：    月    日", fontSize: 14, margin: [10, 5]},
    { text: "收件人員簽名：           ", fontSize: 14, margin: [10, 5]},
    { text: "", margin: [10, 3] },    
    { text: "【 器材借用表 Device Leasing List 】", fontSize: 16, margin: [10, 5] },
    {
      ul: [
        <?php foreach($devices as $index => $device): ?>
         { text: "<?php echo $device['name_zh-TW']."(".$device['name_en-us'].")" ?> 借用數目：<?php echo $device['lease_count']; ?>", fontSize: 14, margin: [20, 3] },
        <?php endforeach; ?>
      ]
    },
  ],
  defaultStyle: {
    font: 'kaiu'
  }
};
 // open the PDF in a new window
 pdfMake.createPdf(docDefinition).download('device_application.pdf');


</script>