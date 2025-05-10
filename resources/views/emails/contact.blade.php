
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
                            <h1 style="font-size:24px; font-weight: 700; text-align: center;color:#3C3C3C;font-family:Arial;text-transform:capitalise;">Contact Form Confirmation</h1>
                            <p style="font-size: 16px; font-weight: 500px; color:#656565;text-align: center;line-height: 150%;font-family:Arial;">
                                Dear {{ $data['fullname'] }},<br><br>

                                This email is to confirm your submission of the contact form. <br>
                                 Please allow for XX days for us to respond. <br>
                                In the meantime, why not browse our services.
                               </p>
                               <table width="100%" cellspacing="0" cellpadding="10" border="0" style="border-collapse: collapse;margin-top:24px;">
                                <td align="center">
                                    <tr>
                                        <td class="gry-color small strong small-text">Full Name:</td>
                                        <td class="text-right small-text">{{ $data['fullname'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="gry-color small small-text">Email:</td>
                                        <td class="text-right small-text">{{ $data['email'] }}</td>
                                    </tr>
                                    @if(isset($data['phone']))
                                        <tr>
                                            <td class="gry-color small small-text">Phone:</td>
                                            <td class="text-right small-text">{{ $data['phone'] }}</td>
                                        </tr>
                                    @endif
                                    @if(isset($data['service']))
                                        <tr>
                                            <td class="gry-color small small-text">Service:</td>
                                            <td class="text-right small-text">{{ $data['service'] }}</td>
                                        </tr>
                                    @endif
                                    @if(isset($data['address']))
                                        <tr>
                                            <td class="gry-color small small-text">Address:</td>
                                            <td class="text-right small-text">{{ $data['address'] }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="gry-color small small-text">Message:</td>
                                        <td class="text-right small-text">{{ $data['message'] }}</td>
                                    </tr>
                                    @if(isset($data['attachment']))
                                        <tr>
                                            <td class="gry-color small small-text">Attachment:</td>
                                            <td class="text-right small-text">{{ asset($data['attachment']) }}</td>
                                        </tr>
                                    @endif
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

