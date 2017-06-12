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
var column_a = [];
column_a.push({ text: '條目', style: 'tableHeader', alignment: 'center', margin: [5, 5]});
column_a.push({ text: '內容', style: 'tableHeader', alignment: 'center', margin: [5, 5]});

var body_a = [column_a];
body_a.push([{ text: '借用日期', alignment: 'center', margin: [8, 5] }, { text: "<?php echo $device_apply['date']; ?>", margin: [8, 5] }]);
body_a.push([{ text: '歸還日期', alignment: 'center', margin: [8, 5] }, { text: "<?php echo $device_apply['end_date']; ?>", margin: [8, 5] }]);
body_a.push([{ text: '借用單位', alignment: 'center', margin: [8, 5] }, { text: "<?php echo $device_apply['organization']; ?>", margin: [8, 5] }]);
body_a.push([{ text: '申請人員', alignment: 'center', margin: [8, 5] }, { text: "<?php echo $device_apply['applicant']; ?>", margin: [8, 5] }]);
body_a.push([{ text: '聯絡電話', alignment: 'center', margin: [8, 5] }, { text: "<?php echo $device_apply['phone']; ?>", margin: [8, 5] }]);
body_a.push([{ text: '借用目的及地點', alignment: 'center', margin: [8, 5] }, { text: "<?php echo $device_apply['purpose']; ?>", margin: [8, 5] }]);

var table_a = {
  table: {
    widths: [ '*', '*'],
    headerRows: 1,
    body: body_a
  },
}

var column_b = [];
column_b.push({ text: '器材名稱', style: 'tableHeader', alignment: 'center', margin: [5, 5]});
column_b.push({ text: '借用數量', style: 'tableHeader', alignment: 'center', margin: [5, 5]});
column_b.push({ text: '編號', style: 'tableHeader', alignment: 'center', margin: [5, 5]});

var body_b = [column_b];
<?php foreach($devices as $index => $device): ?>
  body_b.push([
    { text: '<?php echo $device["name_zh-TW"]."(".$device["name_en-us"].")" ?>', alignment: 'center', margin: [8, 5] },
    { text: '<?php echo $device["lease_count"] ?>', alignment: 'center', margin: [8, 5] },
    { text: '', margin: [8, 5] }
  ]);
<?php endforeach; ?>

var table_b = {
  table: {
    widths: ['*', 'auto', 'auto'],
    headerRows: 1,
    body: body_b
  }
};

var column_c = [];
column_c.push({ text: '條目', style: 'tableHeader', alignment: 'center', margin: [5, 5]});
column_c.push({ text: '內容', style: 'tableHeader', alignment: 'center', margin: [5, 5]});

var body_c = [column_c];
body_c.push([{ text: '出借日期', alignment: 'center', margin: [8, 5] }, { text: '      月      日', alignment: 'center', margin: [8, 5] }]);
body_c.push([{ text: '出借人員簽名', alignment: 'center', margin: [8, 5] }, { text: '', margin: [8, 5] }]);
body_c.push([{ text: '實際歸還日期', alignment: 'center', margin: [8, 5] }, { text: '      月      日', alignment: 'center', margin: [8, 5] }]);
body_c.push([{ text: '收件人員簽名', alignment: 'center', margin: [8, 5] }, { text: '', margin: [8, 5] }]);

var table_c = {
  table: {
    widths: ['*', '*'],
    headerRows: 1,
    body: body_c
  }
}

var docDefinition = {
  content: [
    { text: "器材借用提領單", fontSize: 20, margin: [10, 3], alignment: 'center' },
    { text: "Device Leasing Check List", fontSize: 16, margin: [5, 10], alignment: 'center' },
    { text: '・借用申請資訊', fontSize: 14, margin: [10, 5] },
    table_a,
    { text: "", margin: [10, 3] },
    { text: "・器材借用表", fontSize: 14, margin: [10, 5] },
    table_b,
    { text: "", margin: [10, 3] },
    { text: '・借用申請核對資訊', fontSize: 14, margin: [10, 5] },
    table_c
  ],
  defaultStyle: {
    font: 'kaiu'
  }
};
 // open the PDF in a new window
 pdfMake.createPdf(docDefinition).download('device_application.pdf');


</script>