<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Why Choose LTD Sailing?e</title>
<style>
/* -------------------------------------
    GLOBAL
------------------------------------- */
* {
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
  font-size: 100%;
  line-height: 1.6em;
  margin: 0;
  padding: 0;
}
img {
  max-width: 600px;
  width: auto;
}
body {
  -webkit-font-smoothing: antialiased;
  height: 100%;
  -webkit-text-size-adjust: none;
  width: 100% !important;
}
/* -------------------------------------
    ELEMENTS
------------------------------------- */
a {
  color: #348eda;
}
.btn-primary {
  Margin-bottom: 10px;
  width: auto !important;
}
.btn-primary td {
  background-color: #348eda; 
  border-radius: 25px;
  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
  font-size: 14px; 
  text-align: center;
  vertical-align: top; 
}
.btn-primary td a {
  background-color: #348eda;
  border: solid 1px #348eda;
  border-radius: 25px;
  border-width: 10px 20px;
  display: inline-block;
  color: #ffffff;
  cursor: pointer;
  font-weight: bold;
  line-height: 2;
  text-decoration: none;
}
.last {
  margin-bottom: 0;
}
.first {
  margin-top: 0;
}
.padding {
  padding: 10px 0;
}
/* -------------------------------------
    BODY
------------------------------------- */
table.body-wrap {
  padding: 20px;
  width: 100%;
}
table.body-wrap .container {
  border: 1px solid #f0f0f0;
}
/* -------------------------------------
    FOOTER
------------------------------------- */
table.footer-wrap {
  clear: both !important;
  width: 100%;  
}
.footer-wrap .container p {
  color: #666666;
  font-size: 12px;
  
}
table.footer-wrap a {
  color: #999999;
}
/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, 
h2, 
h3 {
  color: #111111;
  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  font-weight: 400;
  line-height: 1.2em;
  margin: 20px 0 10px;
}
h1 {
  font-size: 36px;
}
h2 {
  font-size: 28px;
}
h3 {
  font-size: 22px;
}
p, 
ul, 
ol {
  font-size: 14px;
  font-weight: normal;
  margin-bottom: 20px;
}
ul li, 
ol li {
  margin-left: 25px;
  margin-bottom: 10px;
  list-style-position: outside;
}
/* ---------------------------------------------------
    RESPONSIVENESS
------------------------------------------------------ */
/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
  clear: both !important;
  display: block !important;
  Margin: 0 auto !important;
  max-width: 600px !important;
}
/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
  padding: 20px;
}
/* This should also be a block element, so that it will fill 100% of the .container */
.content {
  display: block;
  margin: 0 auto;
  max-width: 600px;
}
/* Let's make sure tables in the content area are 100% wide */
.content table {
  width: 100%;
}
</style>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
          <td>
            <p>{{$contact->fullname}},</p>
            <p>Thank you for your interest in booking a trip with LTD Sailing – “Living The Dream!” We are the PREMIER sailing school in the Caribbean. I would love to help you organize your next adventure!</p>
            <p>Do you have time to talk and discuss your sailing plans on the phone? If so, please click <a href="https://LTDsailing.youcanbook.me">HERE</a> (https://LTDsailing.youcanbook.me) to schedule a time. I will give you a call!</p>
            <p>If email works better for you – just let me know and I will follow up via email instead.</p>
            <p>Our courses offer:</p>
            <ul>
              <li>Modern sailing yachts (boats less than five years old). Boats YOU can charter!</li>
              <li>Professional ASA certified instructors and licensed USCG/RYA captains.</li>
              <li>Premier provisioning - enjoy delicious meals while learning to sail in paradise!</li>
              <li>Personal service from day one - we will greet you at the airport!</li>
              <li>Above all we offer an amazing experience sailing in the tropical waters of the Caribbean</li>
            </ul>
            <p>Check out our reviews on <a href="https://www.tripadvisor.com/Attraction_Review-g147296-d4992440-Reviews-LTD_Sailing-St_George_s_Saint_George_Parish_Grenada.html">Trip Advisor</a>!</p>
            <p>We are looking forward to hearing from you soon!</p><br>
            <p>Beam winds,</p>
            <p>Chris Rundlett<br><a href="mailto:chris@ltdsailing.com">chris@ltdsailing.com</a></p>
            <img src="{{asset('images/sm-signature-stamp.jpg')}}">
          </td>
        </tr>
      </table>
      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
  <tr>
    <td></td>
    <td class="container">
      
      <!-- content -->
      <div class="content">
        <table>
          <tr>
            <td align="center">
             
            </td>
          </tr>
        </table>
      </div>
      <!-- /content -->
      
    </td>
    <td></td>
  </tr>
</table>
<!-- /footer -->

</body>
</html>