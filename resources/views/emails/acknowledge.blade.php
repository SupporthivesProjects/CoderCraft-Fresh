
<!DOCTYPE html>
<html>
<body>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" bgcolor="#f2f2f2" style="padding: 20px 0;">
                <table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border-collapse: collapse; box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 0px;">
                            <img src="{{ asset('frontend/BrandSparkz/assets/img/email-header.png') }}" alt="" style="margin: auto; display: block;height:87px;">
                        </td>
                    </tr>
                    <!-- Header End -->
                  
                    <!-- Content -->
                    <tr>
                        <td style="padding: 20px 60px;">
                            <div>
                            <h1 style="font-size:24px; font-weight: 700; text-align: center;color:#3C3C3C;font-family:Arial;text-transform:capitalise;">
                                @if($data['from_page']=="contactus")
                                    Contact Form Confirmation
                                @else
                                    Custom package request
                                @endif
                            </h1>
                            <p style="font-size: 16px; font-weight: 500px; color:#656565;text-align: center;line-height: 150%;font-family:Arial;">
                                Dear {{ $data['fullname'] }},<br><br>

                                This email is to confirm your submission of the contact form. <br>
                                 Please allow for XX days for us to respond. <br>
                                In the meantime, why not browse our services.
                               </p>
                               <table width="100%" cellspacing="0" cellpadding="10" border="0" style="border-collapse: collapse;margin-top:24px;">
                                <td align="center">
                                    <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ route('seo') }}" style="margin-bottom:25px;margin-top:10px;height:50px; v-text-anchor:middle; width:190px;" arcsize="0%"  stroke="f" fillcolor="#D4B88E"><w:anchorlock/><center style="padding-top:20px;padding-bottom:20px;color:#000000;font-size:20px"><![endif]-->
                                     <a href="{{ route('seo') }}" style="color:#FFFFFF;background:#EE5921;padding:16px 40px;font-size: 14px;font-weight:600;text-decoration:none;font-family:Arial;line-height:22px;border-radius:2px;text-transform:capitalize;">Browse services</a>
                                     <!--[if mso]></center></v:roundrect><![endif]-->
                                </td>   
                               </table> 
                             </div>

                        </td>
                    </tr>
                    <!-- Content End-->
                  
                     <!-----------Footer----------->
                     <tr>
                        <td>
                            <!--[if mso]><style>.outlook-back {background: #1F3436 !important;height: 160px;}</style><![endif]--> 
                            <table width="100%" cellspacing="0" cellpadding="" border="0px" style="border-collapse: collapse;"> 
                                <tr style="background: url('{{ asset('frontend/BrandSparkz/assets/img/footer-bg.png') }}'); height:157px; padding:50px; background-size:cover;">
                                    <td style="text-align:center;"><img src="{{ asset('frontend/BrandSparkz/assets/img/Logo.png') }}" alt="">
                                   
                                    </td> 
                                    <td style="text-align:right;">
                                        <p style="font-size: 16px; font-weight:400; color:#3C3C3C;font-style: normal;font-family:Arial;line-height:24px;padding-right:40px;">
                                        info@Companyname.com<br>
                                        123 Main Street, <br>
                                        New York, 10030 
                                        </p>
                                    </td>           
                                </tr>
                                <tr>              
                            </table>
                        </td>
                    </tr> 
                    <!-----------Footer End----------->  
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
