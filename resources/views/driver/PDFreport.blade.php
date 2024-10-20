<!DOCTYPE html>
<html>
<head>
    <title>PDF with Thai Fonts</title>
    <style>
        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: normal;
            src: url('{{ public_path('fonts/THSarabun.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: bold;
            src: url('{{ public_path('fonts/THSarabun Bold.ttf') }}') format('truetype');
        }

        body {
            font-family: 'THSarabun', sans-serif;
            overflow-wrap: break-word;
            font-size: 20px;
            margin-left: 0.5in;
            margin-right: 0.2in;   /* ขอบขวา 1.5 เซนติเมตร */
            line-height: 1; /* ปรับ line-height ให้ชิดกันมากขึ้น */

        }
        h1 {
            font-size: 22px;
            font-weight: bold;
        }
        .content p {
            margin: 0;
            padding: 0;
        }
        .line {
            border-bottom: 1px dotted black;
            width: 248px;
            display: inline-block;
            height: 20px;
            padding-left: 30px;"
        }
        .signature {
            margin-left: 45%;
            overflow-wrap: break-word;
            line-height: 0.89;
        }
        .signature .line {
            border-bottom: 1px dotted black;
            width: 245px;
            display: inline-block;
            height: 20px;
            padding-left: 0px;"

        }
        

    </style>
</head>
<body>
    <h1 class="text-center">บันทึกข้อความ</h1>
    <div class="content">
        <p>
            <b>ส่วนงาน </b><span class="line">
                @foreach($documents->reqDocumentUsers as $docUser)
                    {{ $docUser->division->division_name }}
                @endforeach
        </span> โทร <span class="line" ></span>
        </p>
        
        
        <p style="margin-bottom: 13;"><b style="margin-right: 5; margin-bottom: 20;">เรื่อง </b>ขออนุญาตใช้รถยนต์สถาบันวิจัยทางทะเล</p>
        <p>เรียน <span style="margin-left: 8;"> ผู้อำนวยการ</span></p>
        

    </div>
</body>
</html>
