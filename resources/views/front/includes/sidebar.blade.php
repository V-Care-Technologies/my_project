<div class="main-menu sidebar">
    <nav id="menu"> 
        <ul class="metismenu menu-level-1">
           <li class="item @yield('dashboard_select')">
              <a href="{{route('dashboard')}}" class="link"> 
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none" >
                    <path d="M0 1.43623C0 0.84713 0.477563 0.369568 1.06667 0.369568H7.82018C8.40929 0.369568 8.88685 0.847131 8.88685 1.43623V10.4147C8.88685 11.0038 8.40929 11.4814 7.82018 11.4814H1.06667C0.477563 11.4814 0 11.0038 0 10.4147V1.43623Z" fill="#4EC9F5"/>
                    <path d="M11.1132 11.4362C11.1132 10.8471 11.5907 10.3696 12.1798 10.3696H18.9333C19.5224 10.3696 20 10.8471 20 11.4362V19.3029C20 19.892 19.5224 20.3696 18.9333 20.3696H12.1798C11.5907 20.3696 11.1132 19.892 11.1132 19.3029V11.4362Z" fill="#4EC9F5"/>
                    <path d="M0 14.6768C0 14.0877 0.477563 13.6101 1.06667 13.6101H7.82018C8.40929 13.6101 8.88685 14.0877 8.88685 14.6768V19.3029C8.88685 19.892 8.40929 20.3696 7.82018 20.3696H1.06667C0.477563 20.3696 0 19.892 0 19.3029V14.6768Z" fill="#4EC9F5"/>
                    <path d="M11.1132 1.43624C11.1132 0.847132 11.5907 0.369568 12.1798 0.369568H18.9333C19.5224 0.369568 20 0.847131 20 1.43623V7.12431C20 7.71341 19.5224 8.19098 18.9333 8.19098H12.1798C11.5907 8.19098 11.1132 7.71341 11.1132 7.12431V1.43624Z" fill="#4EC9F5"/>
                 </svg>
                 <span>Dashboard</span>
              </a>
           </li>
           <li class="item @yield('home_banner_select')">
            <a href="{{route('admin.home-banner')}}" class="link"> 
               <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                  <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                  <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
               </svg>
               <span>Home Banner</span>
            </a>
         </li> 
         <li class="item @yield('category_select')">
            <a href="{{route('admin.category')}}" class="link"> 
               <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                  <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                  <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
               </svg>
               <span>Category</span>
            </a>
         </li> 
           {{-- <li class="item">
              <a href="users.html" class="link"> 
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                    <path d="M19.5059 7.1288C18.9058 6.57667 17.9816 6.58267 17.3934 7.1528C16.6372 7.88497 15.8811 8.61113 15.1249 9.3433C15.0709 9.39731 15.0109 9.45132 14.9509 9.51133C14.6088 9.21127 14.2127 9.10324 13.7686 9.10324C12.6343 9.10924 11.5001 9.10324 10.3658 9.10924C10.1138 9.10924 9.86772 9.05523 9.64567 8.9412C8.81749 8.52111 7.94129 8.37108 7.01708 8.50911C5.83482 8.68915 4.8626 9.24127 4.10643 10.1655C3.95639 10.3515 3.82436 10.5556 3.68033 10.7536H3.67433C3.66833 10.7536 3.65632 10.7476 3.65032 10.7476C3.03218 10.5196 2.49206 10.6516 2.02996 11.1197C1.42382 11.7258 0.817684 12.332 0.211548 12.9381C-0.0705159 13.2202 -0.0705159 13.5442 0.211548 13.8263C0.751669 14.3664 1.29179 14.9066 1.83191 15.4467C2.82814 16.4429 3.83036 17.4451 4.82659 18.4413C5.06064 18.6754 5.40272 18.6694 5.64277 18.4353C6.27291 17.8052 6.89705 17.1811 7.5272 16.5509C7.91128 16.1668 8.04331 15.7047 7.92929 15.1706C7.91728 15.1166 7.92929 15.0866 7.95929 15.0506C8.37939 14.6125 8.8955 14.3964 9.50764 14.4024C11.248 14.4084 12.9944 14.4024 14.7348 14.4084C15.2209 14.4084 15.611 14.2224 15.9171 13.8443C17.1594 12.308 18.4076 10.7776 19.6499 9.24727C20.166 8.60513 20.106 7.68692 19.5059 7.1288ZM3.15821 13.5382C2.88215 13.5382 2.6721 13.3222 2.6721 13.0401C2.6721 12.7701 2.89415 12.56 3.16421 12.56C3.44028 12.56 3.65632 12.7821 3.65032 13.0581C3.65032 13.3282 3.43427 13.5382 3.15821 13.5382Z" fill="white"/>
                    <path d="M12.1362 7.91498C11.38 7.91498 10.6239 7.90298 9.8617 7.92098C9.34559 7.93298 8.80547 7.51889 8.85348 6.85874C8.93149 5.86252 9.43561 5.16636 10.3478 4.77027C10.6179 4.65625 10.8999 4.60223 11.188 4.60223C11.8181 4.60223 12.4543 4.60223 13.0844 4.60223C14.2187 4.60824 15.2389 5.50244 15.3829 6.63069C15.407 6.83474 15.425 7.03878 15.3649 7.23683C15.2509 7.63292 14.8728 7.91498 14.4647 7.91498C13.6966 7.91498 12.9164 7.91498 12.1362 7.91498Z" fill="white"/>
                    <path d="M17.5014 6.39663C17.0513 6.39663 16.6072 6.39663 16.1571 6.39663C15.9471 6.39663 15.8031 6.2886 15.731 6.09056C15.521 5.47842 15.1549 4.99231 14.6208 4.62623C14.3687 4.45219 14.3567 4.12812 14.5908 3.93007C14.9749 3.618 15.413 3.45596 15.9051 3.44996C16.4572 3.44396 17.0093 3.44996 17.5615 3.44996C18.6177 3.45596 19.5179 4.26615 19.6319 5.31638C19.6559 5.52043 19.6559 5.72448 19.5599 5.91652C19.3919 6.24059 19.1218 6.39663 18.7617 6.39663C18.3416 6.39663 17.9215 6.39663 17.5014 6.39663Z" fill="white"/>
                    <path d="M6.77105 6.39662C6.35096 6.39662 5.93086 6.39662 5.51077 6.39662C5.08467 6.39662 4.74259 6.13856 4.65257 5.73647C4.59856 5.50842 4.63457 5.27437 4.68858 5.05232C4.89263 4.20013 5.63079 3.55198 6.50699 3.46196C6.62702 3.44996 6.74705 3.44996 6.86707 3.44996C7.40719 3.44996 7.94732 3.44395 8.48744 3.45596C8.94954 3.46796 9.35163 3.648 9.69971 3.94207C9.91576 4.12211 9.89776 4.44618 9.6637 4.60822C9.11758 4.9863 8.73949 5.47841 8.52945 6.10856C8.46943 6.2886 8.3134 6.39062 8.10335 6.39062C7.65925 6.39662 7.21515 6.39662 6.77105 6.39662Z" fill="white"/>
                    <path d="M12.1362 0.851384C13.0724 0.857386 13.8226 1.60755 13.8166 2.54377C13.8106 3.47398 13.0544 4.21814 12.1242 4.21814C11.188 4.21214 10.4498 3.45597 10.4558 2.50776C10.4618 1.60155 11.224 0.845383 12.1362 0.851384Z" fill="white"/>
                    <path d="M9.02753 1.62555C9.02753 2.44774 8.35538 3.11389 7.5332 3.10789C6.71101 3.10789 6.04486 2.43573 6.04486 1.60755C6.04486 0.785362 6.72301 0.125214 7.5452 0.125214C8.36738 0.131215 9.02753 0.797365 9.02753 1.62555Z" fill="white"/>
                    <path d="M15.245 1.61955C15.245 0.791364 15.9111 0.125214 16.7393 0.125214C17.5615 0.125214 18.2336 0.797365 18.2276 1.62555C18.2276 2.44774 17.5555 3.11389 16.7213 3.11389C15.9171 3.10789 15.245 2.43573 15.245 1.61955Z" fill="white"/>
                 </svg>
                 <span>Users</span>
              </a>
           </li>   --}}
           <li class="item @yield('master_select')">
              <a href="#" class="link" aria-expanded="false"> 
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22" fill="none">
                    <path d="M19.1304 6.55812V12.2538C18.8293 12.193 18.5188 12.1965 18.2191 12.2639C17.9195 12.3314 17.6374 12.4612 17.3913 12.6451V11.7755C17.3913 11.199 17.1623 10.646 16.7546 10.2383C16.3469 9.83063 15.7939 9.6016 15.2174 9.6016C14.6408 9.6016 14.0879 9.83063 13.6802 10.2383C13.2725 10.646 13.0435 11.199 13.0435 11.7755V15.2538C12.7205 15.0115 12.3364 14.864 11.9344 14.8278C11.5323 14.7915 11.128 14.8679 10.7669 15.0485C10.4058 15.229 10.1021 15.5066 9.88989 15.85C9.67764 16.1934 9.56522 16.5892 9.56522 16.9929V20.0364H2.82609C2.07656 20.0364 1.35774 19.7386 0.827742 19.2086C0.297747 18.6786 0 17.9598 0 17.2103V6.55812H19.1304ZM16.3043 0.905945C17.0539 0.905945 17.7727 1.20369 18.3027 1.73369C18.8327 2.26368 19.1304 2.98251 19.1304 3.73203V5.25377H0V3.73203C0 2.98251 0.297747 2.26368 0.827742 1.73369C1.35774 1.20369 2.07656 0.905945 2.82609 0.905945H16.3043ZM15.2174 10.4712C14.8715 10.4712 14.5397 10.6086 14.2951 10.8532C14.0505 11.0978 13.913 11.4296 13.913 11.7755V20.4712C13.913 20.8171 14.0505 21.1489 14.2951 21.3935C14.5397 21.6381 14.8715 21.7755 15.2174 21.7755C15.5633 21.7755 15.8951 21.6381 16.1397 21.3935C16.3843 21.1489 16.5217 20.8171 16.5217 20.4712V11.7755C16.5217 11.4296 16.3843 11.0978 16.1397 10.8532C15.8951 10.6086 15.5633 10.4712 15.2174 10.4712ZM11.7391 15.6886C11.3932 15.6886 11.0614 15.826 10.8168 16.0706C10.5722 16.3152 10.4348 16.647 10.4348 16.9929V20.4712C10.4348 20.8171 10.5722 21.1489 10.8168 21.3935C11.0614 21.6381 11.3932 21.7755 11.7391 21.7755C12.0851 21.7755 12.4168 21.6381 12.6614 21.3935C12.9061 21.1489 13.0435 20.8171 13.0435 20.4712V16.9929C13.0435 16.647 12.9061 16.3152 12.6614 16.0706C12.4168 15.826 12.0851 15.6886 11.7391 15.6886ZM17.3913 14.3842C17.3913 14.0383 17.5287 13.7065 17.7733 13.4619C18.018 13.2173 18.3497 13.0799 18.6957 13.0799C19.0416 13.0799 19.3734 13.2173 19.618 13.4619C19.8626 13.7065 20 14.0383 20 14.3842V20.4712C20 20.8171 19.8626 21.1489 19.618 21.3935C19.3734 21.6381 19.0416 21.7755 18.6957 21.7755C18.3497 21.7755 18.018 21.6381 17.7733 21.3935C17.5287 21.1489 17.3913 20.8171 17.3913 20.4712V14.3842Z" fill="white"/>
                 </svg>
                 <span>Product Master</span>
              </a>
              <ul class="menu-level-2" aria-expanded="false">
                 <li class="item "><a href="{{route('admin.color')}}" class="link pt-lg-0 mt-lg-3 @yield('color_select')">Color</a></li>
                 <li class="item "><a href="{{route('admin.size')}}" class="link pt-lg-0 mt-lg-3">Size</a></li> 
                 <li class="item"><a href="{{route('admin.product')}}" class="link @yield('product_select')">Product</a></li>  
              </ul>
           </li> 

           <li class="item @yield('testimonial_select')">
            <a href="{{route('admin.testimonial')}}" class="link"> 
               <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                  <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                  <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
               </svg>
               <span>Testimonial</span>
            </a>
         </li> 
         <li class="item @yield('blog_select')">
            <a href="{{route('admin.blog')}}" class="link"> 
               <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                  <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                  <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
               </svg>
               <span>Blog</span>
            </a>
         </li> 
         <li class="item @yield('order_select')">
            <a href="{{route('admin.order')}}" class="link"> 
               <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                  <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                  <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
               </svg>
               <span>Orders</span>
            </a>
         </li>
         <li class="item @yield('customer_select')">
            <a href="{{route('admin.customer')}}" class="link"> 
               <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                  <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                  <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
               </svg>
               <span>Customer</span>
            </a>
         </li> 
           {{-- <li class="item">
              <a href="orders.html" class="link"> 
                 <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                    <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                    <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
                 </svg>
                 <span>Orders</span>
              </a>
           </li>   --}}
           {{-- <li class="item">
              <a href="#" class="link" aria-expanded="false"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8.86233 1.46011e-06C9.09753 1.46011e-06 9.30793 0.146401 9.38713 0.365601L9.95193 1.9312C10.1543 1.9816 10.3279 2.032 10.4751 2.0848C10.6359 2.1424 10.8431 2.2296 11.0991 2.3488L12.4143 1.6528C12.5217 1.59593 12.6446 1.5754 12.7646 1.59429C12.8846 1.61319 12.9952 1.67049 13.0799 1.7576L14.2367 2.9536C14.3903 3.1128 14.4335 3.3456 14.3471 3.5488L13.7303 4.9944C13.8327 5.1824 13.9143 5.3432 13.9767 5.4776C14.0439 5.624 14.1271 5.8256 14.2263 6.0856L15.6639 6.7016C15.8799 6.7936 16.0135 7.0096 15.9991 7.2408L15.8935 8.9008C15.8863 9.00865 15.8476 9.112 15.7822 9.19804C15.7168 9.28407 15.6275 9.34902 15.5255 9.3848L14.1639 9.8688C14.1247 10.0568 14.0839 10.2176 14.0407 10.3536C13.971 10.5636 13.8915 10.7703 13.8023 10.9728L14.4863 12.4848C14.5346 12.591 14.5476 12.7099 14.5234 12.8241C14.4992 12.9383 14.4391 13.0417 14.3519 13.1192L13.0511 14.2808C12.9655 14.357 12.8586 14.4052 12.7448 14.4189C12.6309 14.4326 12.5156 14.4112 12.4143 14.3576L11.0735 13.6472C10.8638 13.7583 10.6473 13.8563 10.4255 13.9408L9.83993 14.16L9.31993 15.6C9.28139 15.7055 9.21188 15.7968 9.12051 15.862C9.02914 15.9273 8.92018 15.9634 8.80793 15.9656L7.28793 16C7.1727 16.003 7.05936 15.9703 6.96352 15.9062C6.86767 15.8422 6.79403 15.75 6.75273 15.6424L6.13993 14.0208C5.93085 13.9493 5.72383 13.872 5.51913 13.7888C5.3517 13.7163 5.1868 13.6382 5.02473 13.5544L3.50473 14.204C3.40457 14.2467 3.29416 14.2594 3.18692 14.2405C3.07968 14.2216 2.98025 14.172 2.90073 14.0976L1.77593 13.0424C1.69218 12.9642 1.63515 12.8616 1.6129 12.7492C1.59065 12.6368 1.6043 12.5202 1.65193 12.416L2.30553 10.992C2.2186 10.8233 2.13801 10.6515 2.06393 10.4768C1.97745 10.263 1.89741 10.0466 1.82393 9.828L0.391928 9.392C0.275528 9.35682 0.174003 9.28419 0.10312 9.18538C0.0322359 9.08658 -0.00403925 8.96714 -7.22356e-05 8.8456L0.0559278 7.3088C0.0599138 7.20853 0.0912371 7.11126 0.14651 7.0275C0.201783 6.94375 0.278902 6.8767 0.369528 6.8336L1.87193 6.112C1.94153 5.8568 2.00233 5.6584 2.05593 5.5136C2.1314 5.3202 2.21521 5.13015 2.30713 4.944L1.65593 3.568C1.60651 3.46351 1.5915 3.34603 1.61306 3.23247C1.63463 3.11891 1.69165 3.01511 1.77593 2.936L2.89913 1.8752C2.97786 1.80094 3.07638 1.75101 3.18283 1.73143C3.28928 1.71184 3.39911 1.72343 3.49913 1.7648L5.01753 2.392C5.18553 2.28 5.33753 2.1896 5.47513 2.1168C5.63913 2.0296 5.85833 1.9384 6.13433 1.84L6.66233 0.367201C6.70136 0.259416 6.77272 0.166307 6.86664 0.100586C6.96057 0.0348661 7.07249 -0.000261001 7.18713 1.46011e-06H8.86233ZM8.01913 5.6152C6.68553 5.6152 5.60473 6.6832 5.60473 8.0016C5.60473 9.32 6.68553 10.3888 8.01913 10.3888C9.35193 10.3888 10.4327 9.32 10.4327 8.0016C10.4327 6.6832 9.35273 5.6152 8.01913 5.6152Z" fill="#475569"/>
                 </svg>
                 <span>Setting</span>
              </a>
              <ul class="menu-level-2" aria-expanded="false">
                 <li class="item"><a href="#" class="link pt-lg-0 mt-lg-3">Backup</a></li> 
                 <li class="item"><a href="#" class="link">Company Details</a></li>  
              </ul>
           </li> 
           <li class="item">
              <a href="loader.html" class="link"> 
                 <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                    <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                    <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
                 </svg>
                 <span>Loader</span>
              </a>
           </li>   --}}
           {{-- <li class="item">
              <a href="toast.html" class="link"> 
                 <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" viewBox="0 0 17 19" fill="none">
                    <path d="M16.4558 18.2888C11.1044 18.2888 5.82084 18.2888 0.455811 18.2888C0.496558 15.4365 1.66464 13.1954 4.01438 11.6471C6.78518 9.82702 9.73255 9.75911 12.5848 11.4569C15.1112 12.9645 16.3607 15.3007 16.4558 18.2888Z" fill="white"/>
                    <path d="M8.46941 9.27013C6.02458 9.28371 4.05515 7.32786 4.05515 4.89662C4.06873 2.49254 6.02458 0.536684 8.42866 0.523102C10.8599 0.523102 12.8429 2.47896 12.8429 4.9102C12.8293 7.31427 10.8871 9.25655 8.46941 9.27013Z" fill="white"/>
                 </svg>
                 <span>Toast</span>
              </a>
           </li>   --}}
        </ul>
     </nav> 
</div> 