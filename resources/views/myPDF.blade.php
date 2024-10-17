<!DOCTYPE html>
<html>
<head>
    <title>PDF with Thai Fonts</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url('{{ public_path('fonts/THSarabunNew.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url('{{ public_path('fonts/THSarabunNew Bold.ttf') }}') format('truetype');
        }

        body {
            font-family: "THSarabunNew";
            overflow-wrap: break-word;
            font-size: 20px;
            margin-left: 0.5in;
            margin-right: 0.2in;   /* ขอบขวา 1.5 เซนติเมตร */
            line-height: 0.9; /* ปรับ line-height ให้ชิดกันมากขึ้น */

        }
        h1 {
            text-align: center;
            font-weight: bold;
        }
        .content p {
            margin: 0;
            padding: 0;
        }
        .line {
            border-bottom: 1px dotted black;
            width: 278px;
            display: inline-block;
        }
        .br {
            line-height: 0.8; /* ปรับ line-height ให้ชิดกันมากขึ้น */
        }

        .signature {
            margin-left: 45%;
            overflow-wrap: break-word;
            line-height: 0.8;
        }
        .signature .line {
            border-bottom: 1px dotted black;
            width: 240px;
            display: inline-block;
        }
        

    </style>
</head>
<body>
    <h1 class="text-center">บันทึกข้อความ</h1>
    <div class="content">
        <p>
            <b>ส่วนงาน <span class="line"></b>
        </span> โทร <span class="line" ></span></p>
        <p>
            <b>ที่ <span class="line" style="width: 310px;">   
            </span> วันที่ <span class="line" ></span>
            </b>
        </p>
        
        <p style="margin-bottom: 13;"><b style="margin-right: 5; margin-bottom: 20;">เรื่อง </b>ขออนุญาตใช้รถยนต์สถาบันวิจัยทางทะเล</p>
        <p>เรียน <span style="margin-left: 8;"> ผู้อำนวยการ</span></p>
        <p style="margin-left: 35;">ด้วยข้าพเจ้า (นาย/นาง/นางสาว) <span class="line" style="width: 415px;"></span></p>
        <p>พร้อมด้วย <span class="line" style="width: 578px; line-height: 0.7">222</span></p>
        <p style="line-height: 0.7;">2345<span class="line" style="width: 635px;"></span></p>
        <p >1<span class="line" style="width: 635px;"></span></p>
        <p>2<span class="line" style="width: 635px;"></span></p>
        <p style="line-height: 1.2;">รวมทั้งสิ้น <span class="line" style="width: 90px;"></span> คน 
            ขออนุญาตใช้รถยนต์ประเภท <span class="line" style="width: 311px; line-height: ;"></span>
        </p>
        <p>มีความประสงค์ขออนุญาตใช้รถยนต์เพื่อไป <span class="line" style="width: 410px;"></span></p>
        <p style="line-height: 0.7;">1<span class="line" style="width: 635px;"></span></p>
        <p style="line-height: 1.2;">ที่ <span class="line" style="width: 622px;"></span></p>
        <p>
            ตำบล/แขวง <span class="line" style="width: 151px;">
            </span> อำเภอ/เขต <span class="line" style="width: 151px;"></span>
            </span> จังหวัด <span class="line" style="width: 151px;"></span>
        </p>
        <p>โดยให้รถยนต์ไปรับที่ <span class="line" style="width: 523px;"></span></p>
        <p>
            ออกเดินทางในวันที่ <span class="line" style="width: 60px;">
            </span> เดือน <span class="line" style="width: 180px;"></span>
            </span> พ.ศ. <span class="line" style="width: 60px;"></span>
            </span> เวลา <span class="line" style="width: 110px;"></span> น.
        </p>
        <p>
            และกลับในวันที่ <span class="line" style="width: 78px;">
            </span> เดือน <span class="line" style="width: 180px;"></span>
            </span> พ.ศ. <span class="line" style="width: 60px;"></span>
            </span> เวลา <span class="line" style="width: 110px;"></span> น.
        </p>
        <p style="margin-left: 35; line-height: 1.7;">จึงเรียนมาเพื่อโปรดพิจารณาอนุญาต จะเป็นพระคุณยิ่ง</p>
        
        <div class="signature">
            <p style="line-height: 1.7;">ลงชื่อ <span class="line"  ></span> ผู้ขออนุญาต</p>
            <p style="margin-left: 19";>( <span class="line" ></span> )</p>
            <p style="line-height: 1.7; margin-left: 25"><span class="line" ></span> หัวหน้าฝ่าย</p>
        </div>
        <p>
            โปรดพิจารณาอนุญาตให้ใช้รถยนต์หมานเลขทะเบียน <span class="line" style="width: 132px;">
        </span> มี <span class="line" style="width: 210px;"></span></p>
        <p>เป็นพนักงานขับรถยนต์ และ <span class="line" style="width: 403px;"></span> ควบคุมรถยนต์</p>
        <p style="line-height: 1.7;">คำสั่งของผู้อำนวยการ <span class="line" style="width: 516px;"></span</p>
        <p style="line-height: 0.6;">2<span class="line" style="width: 635px;"></span></p>


    </div>
</body>
</html>
