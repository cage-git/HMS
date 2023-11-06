<?php
use App\Room, App\RoomType, App\BookedRoom;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
	//return redirect()->route('login');
});
//Route::get('/update_lang', function () {
//    $array = [
//        "sidemenu_dashboard"=>[
//            "en"=>"Dashboard",
//            "ar"=>"الرئيسية",
//            "hi"=>"डैशबोर्ड",
//        ],
//        "sidemenu_checkin"=>[
//            "en"=>"Check In",
//            "ar"=>"تسجيل دخول",
//            "hi"=>"चेक इन",
//        ],
//        "sidemenu_quick_checkin"=>[
//            "en"=>"Quick Check In",
//            "ar"=>"دخول سريع",
//            "hi"=>"चेक-इन जोड़ें",
//        ],
//        "sidemenu_checkin_add"=>[
//            "en"=>"Add Check In",
//            "ar"=>"إضافة تسجيل دخول",
//            "hi"=>"चेक-इन जोड़ें",
//        ],
//
//        "sidemenu_checkin_all"=>[
//            "en"=>"All Check In`s",
//            "ar"=>"جميع تسجيل دخول",
//            "hi"=>"सभी चेक इन",
//        ],
//        "sidemenu_checkout_all"=>[
//            "en"=>"All Check Out`s",
//            "ar"=>"جميع تسجيل مغادرة",
//            "hi"=>"सभी चेक आउट",
//        ],
//        "sidemenu_users"=>[
//            "en"=>"Users",
//            "ar"=>"المستخدمين",
//            "hi"=>"उपयोगकर्ता",
//        ],
//        "sidemenu_user_add"=>[
//            "en"=>"Add User",
//            "ar"=>"إضافة مستخدم",
//            "hi"=>"उपयोगकर्ता जोड़ें",
//        ],
//        "sidemenu_user_all"=>[
//            "en"=>"All Users",
//            "ar"=>"كل المسجلين",
//            "hi"=>"सभी उपयोगकर्ताओं",
//        ],
//        "sidemenu_customers"=>[
//            "en"=>"Customers",
//            "ar"=>"العملاء",
//            "hi"=>"ग्राहक",
//        ],
//        "sidemenu_customer_add"=>[
//            "en"=>"Add Customer",
//            "ar"=>"إضافة عميل",
//            "hi"=>"ग्राहक जोड़ें",
//        ],
//        "sidemenu_customer_all"=>[
//            "en"=>"All Customers",
//            "ar"=>"كل العملاء",
//            "hi"=>"सभी ग्राहक",
//        ],
//        "sidemenu_fooditems"=>[
//            "en"=>"Food Items",
//            "ar"=>"انواع الأطعمة",
//            "hi"=>"खाद्य - सामग्री",
//        ],
//        "sidemenu_foodcat_add"=>[
//            "en"=>"Add Food Category",
//            "ar"=>"إضافة تصنيف الأطعمة",
//            "hi"=>"खाद्य श्रेणी जोड़ें",
//        ],
//        "sidemenu_foodcat_all"=>[
//            "en"=>"All FoodCategory",
//            "ar"=>"كل تصنيفات الأطعمة",
//            "hi"=>"सभी खाद्य श्रेणी",
//        ],
//        "sidemenu_fooditem_add"=>[
//            "en"=>"Add Food Item",
//            "ar"=>"إضافة تصنيف الأطعمة",
//            "hi"=>"खाद्य पदार्थ जोड़ें",
//        ],
//        "sidemenu_fooditem_all"=>[
//            "en"=>"All Food Item",
//            "ar"=>"كل منتجات الطعام",
//            "hi"=>"सभी खाद्य पदार्थ",
//        ],
//        "sidemenu_product_add"=>[
//            "en"=>"Add Product",
//            "ar"=>"إضافة منتج",
//            "hi"=>"उत्पाद जोड़ें",
//        ],
//        "sidemenu_product_all"=>[
//            "en"=>"All Products",
//            "ar"=>"كل المنتجات",
//            "hi"=>"सारे उत्पाद",
//        ],
//        "sidemenu_stocks"=>[
//            "en"=>"Stocks",
//            "ar"=>"المخزون",
//            "hi"=>"स्टॉक्स",
//        ],
//        "sidemenu_stock_add"=>[
//            "en"=>"Add Stock",
//            "ar"=>"إضافة مخزون",
//            "hi"=>"स्टॉक जोड़ें",
//        ],
//        "sidemenu_stock_history"=>[
//            "en"=>"Stocks History",
//            "ar"=>"تسجيلات المخزون",
//            "hi"=>"स्टॉक्स इतिहास",
//        ],
//        "sidemenu_roomtypes"=>[
//            "en"=>"Room Types",
//            "ar"=>"نوع الشقة",
//            "hi"=>"कक्ष के प्रकार",
//        ],
//        "sidemenu_roomtype_add"=>[
//            "en"=>"Add Room Type",
//            "ar"=>"إضافة نوع الشقة",
//            "hi"=>"कक्ष प्रकार जोड़ें",
//        ],
//        "sidemenu_roomtype_all"=>[
//            "en"=>"All Room Types",
//            "ar"=>"كل أنواع الشقق",
//            "hi"=>"सभी प्रकार के कक्ष",
//        ],
//        "sidemenu_rooms"=>[
//            "en"=>"Rooms",
//            "ar"=>"الغرف",
//            "hi"=>"कक्ष",
//        ],
//        "sidemenu_room_add"=>[
//            "en"=>"Add Room",
//            "ar"=>"إضافة غرفة",
//            "hi"=>"कक्ष जोड़ें",
//        ],
//        "sidemenu_room_all"=>[
//            "en"=>"All Rooms",
//            "ar"=>"كل الغرف",
//            "hi"=>"सभी कक्ष",
//        ],
//        "sidemenu_amenities"=>[
//            "en"=>"Amenities",
//            "ar"=>"المميزات",
//            "hi"=>"सुविधा",
//        ],
//        "sidemenu_amenities_add"=>[
//            "en"=>"Add Amenities",
//            "ar"=>"إضافة المميزات",
//            "hi"=>"सुविधा जोड़ें",
//        ],
//        "sidemenu_amenities_all"=>[
//            "en"=>"All Amenities",
//            "ar"=>"كل المميزات",
//            "hi"=>"सभी सुविधा",
//        ],
//        "sidemenu_settings"=>[
//            "en"=>"Settings",
//            "ar"=>"الإعدادات",
//            "hi"=>"सेटिंग्स",
//        ],
//        "sidemenu_permissions"=>[
//            "en"=>"Permissions",
//            "ar"=>"الصلاحيات",
//            "hi"=>"अनुमतियां",
//        ],
//        "sidemenu_expense"=>[
//            "en"=>"Expense",
//            "ar"=>"المصاريف",
//            "hi"=>"व्यय",
//        ],
//        "sidemenu_expensecat_add"=>[
//            "en"=>"Add Category",
//            "ar"=>"إضافة تصنيف",
//            "hi"=>"श्रेणी जोड़े",
//        ],
//        "sidemenu_expensecat_all"=>[
//            "en"=>"All Category",
//            "ar"=>"كل التصنيفات",
//            "hi"=>"सभी श्रेणी",
//        ],
//        "sidemenu_expense_add"=>[
//            "en"=>"Add Expense",
//            "ar"=>"إضافة مصاريف",
//            "hi"=>"व्यय जोड़ें",
//        ],
//        "sidemenu_expense_all"=>[
//            "en"=>"All Expense",
//            "ar"=>"كل المصاريف",
//            "hi"=>"सभी व्यय",
//        ],
//        "sidemenu_dynamic_dropdowns"=>[
//            "en"=>"Dynamic Dropdowns",
//            "ar"=>"قائمة متحركة",
//            "hi"=>"सभी व्यय",
//        ],
//        "sidemenu_reports"=>[
//            "en"=>"Reports",
//            "ar"=>"تقارير",
//            "hi"=>"विवरण",
//        ],
//        "sidemenu_checkin_report"=>[
//            "en"=>"Check-Ins Reports",
//            "ar"=>"تقارير تسجيلات الدخول",
//            "hi"=>"चेक-इन रिपोर्ट",
//        ],
//        "sidemenu_checkout_report"=>[
//            "en"=>"Check-Outs Report",
//            "ar"=>"تقرير تسجيلات الخروج",
//            "hi"=>"चेक-आउट रिपोर्ट",
//        ],
//        "sidemenu_sales_report"=>[
//            "en"=>"Sales Report",
//            "ar"=>"تقرير المبيعات",
//            "hi"=>"बिक्री रिपोर्ट",
//        ],
//        "sidemenu_expense_report"=>[
//            "en"=>"Expense Report",
//            "ar"=>"تقرير المصاريف",
//            "hi"=>"खर्च रिपोर्ट्",
//        ],
//        "sidemenu_transactions_report"=>[
//            "en"=>"Transactions Report",
//            "ar"=>"تقرير التحويلات",
//            "hi"=>"लेनदेन रिपोर्ट",
//        ],
//        "heading_login"=>[
//            "en"=>"Login",
//            "ar"=>"دخول",
//            "hi"=>"लॉग इन",
//        ],
//        "heading_site_settings"=>[
//            "en"=>"Site Settings",
//            "ar"=>"إعدادات الموقع",
//            "hi"=>"साइट सेटिंग्स",
//        ],
//        "heading_gst_settings"=>[
//            "en"=>"Tax Settings",
//            "ar"=>"إعدادات الضرائب",
//            "hi"=>"जीएसटी सेटिंग्स",
//        ],
//        "heading_smsapi_settings"=>[
//            "en"=>"SMS Api Settings",
//            "ar"=>"إعدادات الرسائل ",
//            "hi"=>"एसएमएस एपीआई सेटिंग्स",
//        ],
//        "heading_currency_settings"=>[
//            "en"=>"Currency Settings",
//            "ar"=>"إعدادات العملات",
//            "hi"=>"मुद्रा सेटिंग्स",
//        ],
//        "heading_default_settings"=>[
//            "en"=>"Default Settings",
//            "ar"=>"الإعدادات الإفتراضية",
//            "hi"=>"डिफ़ॉल्ट सेटिंग्स",
//        ],
//        "heading_food_category"=>[
//            "en"=>"Food Category",
//            "ar"=>"تصنيف الأطعمة",
//            "hi"=>"खाद्य श्रेणी",
//        ],
//        "heading_food_category_list"=>[
//            "en"=>"List Food Category",
//            "ar"=>"قائمة تصنيف الأطعمة",
//            "hi"=>"सूची खाद्य श्रेणी",
//        ],
//        "heading_food_item"=>[
//            "en"=>"Food Item",
//            "ar"=>"منتج الطعام",
//            "hi"=>"खाद्य - सामग्री",
//        ],
//        "heading_food_item_list"=>[
//            "en"=>"List Food Items",
//            "ar"=>"قائمة منتجات الأطعمة",
//            "hi"=>"सूची खाद्य पदार्थ",
//        ],
//        "heading_expense_category"=>[
//            "en"=>"Expense Category",
//            "ar"=>"تصنيف المصاريف",
//            "hi"=>"व्यय की श्रेणी",
//        ],
//        "heading_expense_category_list"=>[
//            "en"=>"List Expense Category",
//            "ar"=>"قائمة تصنيف المصاريف",
//            "hi"=>"सूची व्यय श्रेणी",
//        ],
//        "heading_expense"=>[
//            "en"=>"Expenses",
//            "ar"=>"المصاريف",
//            "hi"=>"व्यय",
//        ],
//        "heading_filter_expense"=>[
//            "en"=>"Filter Expense",
//            "ar"=>"تصفية المصاريف",
//            "hi"=>"फ़िल्टर व्यय",
//        ],
//        "heading_filter_customer"=>[
//            "en"=>"Filter Customer",
//            "ar"=>"تصفية العملاء",
//            "hi"=>"फ़िल्टर ग्राहक",
//        ],
//        "heading_expense_list"=>[
//            "en"=>"List Expenses",
//            "ar"=>"قائمة المصاريف",
//            "hi"=>"सूची व्यय",
//        ],
//        "heading_customer_info"=>[
//            "en"=>"Customer Information",
//            "ar"=>"بيانات العميل",
//            "hi"=>"ग्राहक सूचना",
//        ],
//        "heading_filter_orders"=>[
//            "en"=>"Filter Orders",
//            "ar"=>"ترتيب التصفية",
//            "hi"=>"फ़िल्टर ऑर्डर",
//        ],
//        "heading_all_orders"=>[
//            "en"=>"All Orders",
//            "ar"=>"كل الترتيبات",
//            "hi"=>"सभी ऑर्डर",
//        ],
//        "heading_add_product"=>[
//            "en"=>"Add Product",
//            "ar"=>"إضافة منتج",
//            "hi"=>"उत्पाद जोड़ें",
//        ],
//        "heading_update_product"=>[
//            "en"=>"Update Product",
//            "ar"=>"تعديل منتج",
//            "hi"=>"अद्यतन उत्पाद",
//        ],
//        "heading_list_product"=>[
//            "en"=>"List Products",
//            "ar"=>"قائمة المنتجات",
//            "hi"=>"उत्पादों की सूची",
//        ],
//        "heading_guest_type"=>[
//            "en"=>"Guest Type",
//            "ar"=>"نوع النزيل",
//            "hi"=>"अतिथि प्रकार",
//        ],
//        "heading_existing_guest_list"=>[
//            "en"=>"Existing Guest List",
//            "ar"=>"قائمة النزلاء الحالية",
//            "hi"=>"मौजूदा अतिथि सूची",
//        ],
//        "heading_guest_info"=>[
//            "en"=>"Guest Information",
//            "ar"=>"بيانات النزيل",
//            "hi"=>"अतिथि जानकारी",
//        ],
//        "heading_checkin_info"=>[
//            "en"=>"Check In Information",
//            "ar"=>"بيانات تسجيل الدخول",
//            "hi"=>"चेक-इन सूचना",
//        ],
//        "heading_idcard_info"=>[
//            "en"=>"ID Card Information",
//            "ar"=>"بيانات الهوية",
//            "hi"=>"आईडी कार्ड की जानकारी",
//        ],
//        "heading_person_info"=>[
//            "en"=>"Information of Other Person",
//            "ar"=>"بيانات أشخاص اخرين",
//            "hi"=>"अन्य व्यक्ति की जानकारी",
//        ],
//        "heading_payment_info"=>[
//            "en"=>"Payment Information",
//            "ar"=>"بيانات الدفع",
//            "hi"=>"भुगतान की जानकारी",
//        ],
//        "heading_filter_checkouts"=>[
//            "en"=>"Filter Checkouts",
//            "ar"=>"تصفية المغادرة",
//            "hi"=>"फ़िल्टर चेकआउट",
//        ],
//        "heading_checkin_list"=>[
//            "en"=>"Check In List",
//            "ar"=>"قائمة تسجيل الدخول",
//            "hi"=>"चेक-इन सूची",
//        ],
//        "heading_checkout_list"=>[
//            "en"=>"Check Out List",
//            "ar"=>"قائمة المغادرة",
//            "hi"=>"चेक-आउट सूची",
//        ],
//        "heading_checkInOut_info"=>[
//            "en"=>"Check In/Out Information",
//            "ar"=>"بيانات الدخول والمغادرة",
//            "hi"=>"चेक इन/आउट सूचना",
//        ],
//        "heading_additional_info"=>[
//            "en"=>"Additional Information",
//            "ar"=>"بيانات إضافية",
//            "hi"=>"अतिरिक्त जानकारी",
//        ],
//        "heading_update_password"=>[
//            "en"=>"Update Password",
//            "ar"=>"تحديث الرقم السري",
//            "hi"=>"पासवर्ड अपडेट करें",
//        ],
//        "heading_update_profile"=>[
//            "en"=>"Update Profile",
//            "ar"=>"تحديث الملف الشخصي",
//            "hi"=>"प्रोफ़ाइल अपडेट करें",
//        ],
//        "heading_stock_history"=>[
//            "en"=>"Stocks History",
//            "ar"=>"تسجيلات المخزون",
//            "hi"=>"स्टॉक्स इतिहास",
//        ],
//        "heading_filter_stock_history"=>[
//            "en"=>"Filter Stocks History",
//            "ar"=>"تصفية تسجيلات المخزون",
//            "hi"=>"फ़िल्टर स्टॉक इतिहास",
//        ],
//        "heading_manage_inventory"=>[
//            "en"=>"Manage Inventory",
//            "ar"=>"إدارة الجرد",
//            "hi"=>"इन्वेंटरी का प्रबंधन",
//        ],
//        "heading_term_and_conditions"=>[
//            "en"=>"Term & Conditions",
//            "ar"=>"الشروط والأحكام",
//            "hi"=>"नियम और शर्तें",
//        ],
//        "heading_list_roomtypes"=>[
//            "en"=>"List Room Type",
//            "ar"=>"قائمة أنواع الشقق",
//            "hi"=>"सभी प्रकार के कमरे",
//        ],
//        "heading_list_permission"=>[
//            "en"=>"All Permissions",
//            "ar"=>"كل الصلاحيات",
//            "hi"=>"सभी अनुमतियां",
//        ],
//        "heading_list_dynamic_dropdowns"=>[
//            "en"=>"All Dropdowns",
//            "ar"=>"كل القوائم",
//            "hi"=>"सभी ड्रॉपडाउन",
//        ],
//        "heading_bank_settings"=>[
//            "en"=>"Bank Settings",
//            "ar"=>"إعدادات البنك",
//            "hi"=>"बैंक सेटिंग्स",
//        ],
//        "heading_website_settings"=>[
//            "en"=>"Website Settings",
//            "ar"=>"إعدادات الموقع",
//            "hi"=>"वेबसाइट सेटिंग्स",
//        ],
//        "btn_repeat_order"=>[
//            "en"=>"Repeat Order",
//            "ar"=>"إعادة الطلب",
//            "hi"=>"दुबारा ऑर्डर",
//        ],
//        "btn_view_order"=>[
//            "en"=>"View Order",
//            "ar"=>"إظهار الطلب",
//            "hi"=>"ऑर्डर देखें",
//        ],
//        "btn_pay"=>[
//            "en"=>"Pay",
//            "ar"=>"الدفع",
//            "hi"=>"वेतन",
//        ],
//        "btn_submit"=>[
//            "en"=>"Submit",
//            "ar"=>"حفظ",
//            "hi"=>"प्रस्तुत",
//        ],
//        "btn_add"=>[
//            "en"=>"Add",
//            "ar"=>"أضف",
//            "hi"=>"जोड़ना",
//        ],
//        "btn_update"=>[
//            "en"=>"Update",
//            "ar"=>"تحديث",
//            "hi"=>"अपडेट",
//        ],
//        "btn_save"=>[
//            "en"=>"Save",
//            "ar"=>"حفظ",
//            "hi"=>"सहेजें",
//        ],
//        "btn_cancel"=>[
//            "en"=>"Cancel",
//            "ar"=>"إلغاء",
//            "hi"=>"रद्द",
//        ],
//        "btn_delete"=>[
//            "en"=>"Delete",
//            "ar"=>"حذف",
//            "hi"=>"हटाएं",
//        ],
//        "btn_reset"=>[
//            "en"=>"Reset",
//            "ar"=>"إعادة",
//            "hi"=>"रीसेट",
//        ],
//        "btn_print"=>[
//            "en"=>"Print",
//            "ar"=>"طباعة",
//            "hi"=>"छाप",
//        ],
//        "btn_go_back"=>[
//            "en"=>"Go To Back",
//            "ar"=>"الرجوع للخلف",
//            "hi"=>"वापस जाएं",
//        ],
//        "btn_login"=>[
//            "en"=>"Log in",
//            "ar"=>"دخول",
//            "hi"=>"लॉग इन",
//        ],
//        "btn_search"=>[
//            "en"=>"Search",
//            "ar"=>"بحث",
//            "hi"=>"खोज",
//        ],
//        "btn_export"=>[
//            "en"=>"Export",
//            "ar"=>"تصدير",
//            "hi"=>"निर्यात",
//        ],
//        "btn_view_item"=>[
//            "en"=>"View Items",
//            "ar"=>"إظهر المنتجات",
//            "hi"=>"आइटम देखें",
//        ],
//        "btn_view"=>[
//            "en"=>"View",
//            "ar"=>"إظهار",
//            "hi"=>"देखें",
//        ],
//        "btn_view_all"=>[
//            "en"=>"View All",
//            "ar"=>"إظهار الكل",
//            "hi"=>"देखें",
//        ],
//        "btn_invoice_food"=>[
//            "en"=>"Invoice Food",
//            "ar"=>"فاتورة الأطعمة",
//            "hi"=>"रसीद खाना",
//        ],
//        "btn_invoice_room"=>[
//            "en"=>"Invoice Room",
//            "ar"=>"فاتورة الغرفة",
//            "hi"=>"रसीद कक्ष",
//        ],
//        "btn_invoice_room_org"=>[
//            "en"=>"Inv Room Original",
//            "ar"=>"فاتورة الغرفة الأصلية",
//            "hi"=>"रसीद कक्ष",
//        ],
//        "btn_invoice_room_dup"=>[
//            "en"=>"Inv Room Duplicate",
//            "ar"=>"نسخة فاتورة الغرفة",
//            "hi"=>"रसीद कक्ष",
//        ],
//        "btn_food_order"=>[
//            "en"=>"Food Order",
//            "ar"=>"طلب الطعام",
//            "hi"=>"खाद्य ऑर्डर",
//        ],
//        "btn_checkin"=>[
//            "en"=>"Check In",
//            "ar"=>"تسجيل الدخول",
//            "hi"=>"चेक इन",
//        ],
//        "btn_checkout"=>[
//            "en"=>"Check Out",
//            "ar"=>"تسجيل مغادرة",
//            "hi"=>"चेक आउट",
//        ],
//        "btn_cancel_reservation"=>[
//            "en"=>"Cancel Reservation",
//            "ar"=>"إلغاء الحجز",
//            "hi"=>"चेक आउट",
//        ],
//        "reservation_is_cancelled"=>[
//            "en"=>"Reservation is canceled",
//            "ar"=>"تم إلغاء الحجز",
//            "hi"=>"चेक आउट",
//        ],
//
//        "btn_advance_slip"=>[
//            "en"=>"Advance Slip",
//            "ar"=>"فاتورة دفع مقدم",
//            "hi"=>"अग्रिम पर्ची",
//        ],
//        "btn_advance_pay"=>[
//            "en"=>"Advance Pay",
//            "ar"=>"دفع مقدم",
//            "hi"=>"अग्रिम भुगतान",
//        ],
//        "btn_swap_room"=>[
//            "en"=>"Swap Room",
//            "ar"=>"تبديل غرفة",
//            "hi"=>"स्वैप रूम",
//        ],
//        "btn_mark_as_paid"=>[
//            "en"=>"Mark as Paid",
//            "ar"=>"تحديد كمدفوع",
//            "hi"=>"भुगतान के रूप में चिह्नित करें",
//        ],
//        "btn_update_customer_info"=>[
//            "en"=>"Update Guest Info",
//            "ar"=>"تحديث بيانات النزيل",
//            "hi"=>"अतिथि जानकारी अपडेट करें",
//        ],
//        "ph_enter"=>[
//            "en"=>"Enter ",
//            "ar"=>"أكمل ",
//            "hi"=>"दर्ज",
//        ],
//        "ph_select"=>[
//            "en"=>"--Select--",
//            "ar"=>"--إختر--",
//            "hi"=>"--चयन--",
//        ],
//        "ph_qty"=>[
//            "en"=>"Enter Qty",
//            "ar"=>"أدخل الكمية",
//            "hi"=>"मात्रा दर्ज करें",
//        ],
//        "ph_date"=>[
//            "en"=>"Select Date",
//            "ar"=>"إختر تاريخ",
//            "hi"=>"तारीख़ चुनें",
//        ],
//        "ph_date_from"=>[
//            "en"=>"Select Date From",
//            "ar"=>"إختر تاريخ من",
//            "hi"=>"से दिनांक का चयन करें",
//        ],
//        "ph_date_to"=>[
//            "en"=>"Select Date To",
//            "ar"=>"إختر تاريخ إلى",
//            "hi"=>"दिनांक का चयन करें",
//        ],
//        "ph_day_night"=>[
//            "en"=>"Enter Number of Days/Night",
//            "ar"=>"أدخل عدد الأيام/الليالي",
//            "hi"=>"दिन/रात की संख्या दर्ज करें",
//        ],
//        "ph_any_discount"=>[
//            "en"=>"Enter Any Discount",
//            "ar"=>"أدخل أي خصم",
//            "hi"=>"कोई भी छूट दर्ज करें",
//        ],
//        "txt_welcome"=>[
//            "en"=>"Welcome",
//            "ar"=>"أهلاً",
//            "hi"=>"स्वागत",
//        ],
//        "txt_profile"=>[
//            "en"=>"Profile",
//            "ar"=>"الملف الشخصي",
//            "hi"=>"प्रोफ़ाइल",
//        ],
//        "txt_logout"=>[
//            "en"=>"Logout",
//            "ar"=>"خروج",
//            "hi"=>"लॉग आउट",
//        ],
//        "txt_rights_res"=>[
//            "en"=>"All Rights Reserved",
//            "ar"=>"جميع الحقوق محفوظة",
//            "hi"=>"सभी अधिकार सुरक्षित",
//        ],
//        "txt_today_checkin"=>[
//            "en"=>"Today`s Check-Ins",
//            "ar"=>"تسجيلات دخول اليوم",
//            "hi"=>"आज चेक इन",
//        ],
//        "txt_today_checkout"=>[
//            "en"=>"Today`s Check-Outs",
//            "ar"=>"تسجيلات المغادرة اليوم",
//            "hi"=>"आज चेक आउट",
//        ],
//        "txt_today_orders"=>[
//            "en"=>"Today`s Occupancy",
//            "ar"=>"إشغال اليوم",
//            "hi"=>"आज ऑर्डर",
//        ],
//        "txt_add_new_orders"=>[
//            "en"=>"Add New Order",
//            "ar"=>"إضافة طلب جديد",
//            "hi"=>"नया ऑर्डर जोड़ें",
//        ],
//        "txt_latest_orders"=>[
//            "en"=>"Latest Orders",
//            "ar"=>"أحدث الطلبات",
//            "hi"=>"नवीनतम ऑर्डर",
//        ],
//        "txt_sno"=>[
//            "en"=>"S.No",
//            "ar"=>"رقم",
//            "hi"=>"S.No",
//        ],
//        "txt_customer_name"=>[
//            "en"=>"Customer Name",
//            "ar"=>"إسم العميل",
//            "hi"=>"ग्राहक का नाम",
//        ],
//
//        "txt_customer_email"=>[
//            "en"=>"Customer E-mail",
//            "ar"=>"إيميل العميل",
//            "hi"=>"ग्राहक ईमेल",
//        ],
//        "txt_customer_mobile"=>[
//            "en"=>"Customer Mobile",
//            "ar"=>"رقم العميل",
//            "hi"=>"ग्राहक मोबाइल",
//        ],
//        "txt_table_num"=>[
//            "en"=>"Table No.",
//            "ar"=>"رقم الطاولة.",
//            "hi"=>"तालिका संख्या",
//        ],
//        "txt_room_num"=>[
//            "en"=>"Room No.",
//            "ar"=>"رقم الغرفة.",
//            "hi"=>"कमरा क्रमांक।",
//        ],
//        "txt_order_amount"=>[
//            "en"=>"Order Amount",
//            "ar"=>"كمية الطلب",
//            "hi"=>"ऑर्डर करने की राशि",
//        ],
//        "txt_action"=>[
//            "en"=>"Action",
//            "ar"=>"حركة",
//            "hi"=>"कार्य",
//        ],
//        "txt_order_details"=>[
//            "en"=>"Order Details",
//            "ar"=>"تفاصيل الطلب",
//            "hi"=>"ऑर्डर का विवरण",
//        ],
//        "txt_datetime"=>[
//            "en"=>"Datetime",
//            "ar"=>"تاريخ الوقت",
//            "hi"=>"दिनांक और समय",
//        ],
//        "txt_orderitem_qty"=>[
//            "en"=>"Order Items & Quantity",
//            "ar"=>"طلب المنتجات و الكمية",
//            "hi"=>"ऑर्डर आइटम और मात्रा",
//        ],
//        "txt_stock"=>[
//            "en"=>"Stock",
//            "ar"=>"المخزون",
//            "hi"=>"भण्डार",
//        ],
//        "txt_product_stocks"=>[
//            "en"=>"Product Stocks",
//            "ar"=>"مخزون المنتج",
//            "hi"=>"उत्पाद स्टॉक",
//        ],
//        "txt_current_stocks"=>[
//            "en"=>"Current Stocks",
//            "ar"=>"المخزون الحالي",
//            "hi"=>"वर्तमान स्टॉक",
//        ],
//        "txt_product"=>[
//            "en"=>"Product",
//            "ar"=>"المنتج",
//            "hi"=>"उत्पाद",
//        ],
//        "txt_unit"=>[
//            "en"=>"Unit",
//            "ar"=>"الوحدة",
//            "hi"=>"इकाई",
//        ],
//        "txt_site_page_title"=>[
//            "en"=>"Site Page Title",
//            "ar"=>"عنوان صفحة الموقع",
//            "hi"=>"साइट पेज शीर्षक",
//        ],
//        "txt_site_lang"=>[
//            "en"=>"Site Language",
//            "ar"=>"لغة الموقع",
//            "hi"=>"साइट की भाषा",
//        ],
//        "txt_hotel_name"=>[
//            "en"=>"Hotel Name",
//            "ar"=>"إسم الفندق",
//            "hi"=>"होटल का नाम",
//        ],
//        "txt_hotel_tagline"=>[
//            "en"=>"Hotel Tagline",
//            "ar"=>"تسطير الفندق",
//            "hi"=>"होटल टैगलाइन",
//        ],
//        "txt_hotel_email"=>[
//            "en"=>"Hotel E-mail",
//            "ar"=>"إيميل الفندق",
//            "hi"=>"होटल ईमेल",
//        ],
//        "txt_hotel_phone"=>[
//            "en"=>"Hotel Phone",
//            "ar"=>"هاتف الفندق",
//            "hi"=>"होटल फोन",
//        ],
//        "txt_hotel_mobile"=>[
//            "en"=>"Hotel Mobile",
//            "ar"=>"جوال الفندق",
//            "hi"=>"होटल मोबाइल",
//        ],
//        "txt_hotel_website"=>[
//            "en"=>"Hotel Website",
//            "ar"=>"موقع الفندق",
//            "hi"=>"होटल की वेबसाइट",
//        ],
//        "txt_hotel_address"=>[
//            "en"=>"Hotel Address",
//            "ar"=>"عنوان الفندق",
//            "hi"=>"होटल का पता",
//        ],
//        "txt_gstin"=>[
//            "en"=>"Tax Number",
//            "ar"=>"رقم الضريبي",
//            "hi"=>"जीएसटीआईएन",
//        ],
//        "txt_room_rent_gst"=>[
//            "en"=>"Room Rent Tax",
//            "ar"=>"ضريبة إيجار الغرفة",
//            "hi"=>"कमरे का किराया जी.एस.टी.",
//        ],
//        "txt_food_gst"=>[
//            "en"=>"Accomodation Tax",
//            "ar"=>"ضريبة الإيواء",
//            "hi"=>"खाद्य जी.एस.टी.",
//        ],
//        "txt_gst"=>[
//            "en"=>"Tax",
//            "ar"=>"الضريبة",
//            "hi"=>"जी.एस.टी.",
//        ],
//        "txt_sgst_"=>[
//            "en"=>"STax",
//            "ar"=>"الضريبة",
//            "hi"=>"एस.जी.एस.टी",
//        ],
//        "txt_sgst"=>[
//            "en"=>"Tax",
//            "ar"=>"الضريبة",
//            "hi"=>"जी.एस.टी",
//        ],
//        "txt_cgst"=>[
//            "en"=>"CTax",
//            "ar"=>"الضريبة",
//            "hi"=>"सी.जी.एस.टी",
//        ],
//        "txt_gst_apply"=>[
//            "en"=>"Tax Apply",
//            "ar"=>"خاضع للضريبة",
//            "hi"=>"जीएसटी लागू",
//        ],
//        "txt_category_name"=>[
//            "en"=>"Category Name",
//            "ar"=>"إسم التصنيف",
//            "hi"=>"श्रेणी नाम",
//        ],
//        "txt_status"=>[
//            "en"=>"Status",
//            "ar"=>"الحالة",
//            "hi"=>"स्थिति",
//        ],
//        "txt_category"=>[
//            "en"=>"Category",
//            "ar"=>"التصنيف",
//            "hi"=>"श्रेणी",
//        ],
//        "txt_item_name"=>[
//            "en"=>"Item Name",
//            "ar"=>"إسم المنتج",
//            "hi"=>"वस्तु का नाम",
//        ],
//        "txt_price"=>[
//            "en"=>"Price",
//            "ar"=>"السعر",
//            "hi"=>"कीमत",
//        ],
//        "txt_desc"=>[
//            "en"=>"Description",
//            "ar"=>"التفاصيل",
//            "hi"=>"विवरण",
//        ],
//        "txt_invoice"=>[
//            "en"=>"Invoice",
//            "ar"=>"الفاتورة",
//            "hi"=>"रसीद",
//        ],
//        "txt_name"=>[
//            "en"=>"Name",
//            "ar"=>"الإسم",
//            "hi"=>"नाम",
//        ],
//        "txt_fullname"=>[
//            "en"=>"Full name",
//            "ar"=>"الإسم كامل",
//            "hi"=>"पूरा नाम",
//        ],
//        "txt_father_name"=>[
//            "en"=>"Father Name",
//            "ar"=>"إسم الأب",
//            "hi"=>"पिता का नाम",
//        ],
//        "txt_mobile_num"=>[
//            "en"=>"Mobile No.",
//            "ar"=>"رقم الجوال.",
//            "hi"=>"मोबाइल नंबर",
//        ],
//        "txt_city"=>[
//            "en"=>"City",
//            "ar"=>"المدينة",
//            "hi"=>"शहर",
//        ],
//        "txt_state"=>[
//            "en"=>"State",
//            "ar"=>"المنطقة",
//            "hi"=>"राज्य",
//        ],
//        "txt_country"=>[
//            "en"=>"Country",
//            "ar"=>"الدولة",
//            "hi"=>"देश",
//        ],
//        "txt_nationality"=>[
//            "en"=>"Nationality",
//            "ar"=>"الجنسية",
//            "hi"=>"राष्ट्रीयता",
//        ],
//        "txt_ph"=>[
//            "en"=>"Ph",
//            "ar"=>"هاتف",
//            "hi"=>"Ph",
//        ],
//        "txt_mob"=>[
//            "en"=>"M",
//            "ar"=>"جوال",
//            "hi"=>"M",
//        ],
//        "txt_num"=>[
//            "en"=>"No.",
//            "ar"=>"رقم.",
//            "hi"=>"संख्या",
//        ],
//        "txt_dated"=>[
//            "en"=>"Dated",
//            "ar"=>"مؤرخ",
//            "hi"=>"दिनांक",
//        ],
//        "txt_date"=>[
//            "en"=>"Date",
//            "ar"=>"تاريخ",
//            "hi"=>"दिनांक",
//        ],
//        "txt_cust_name"=>[
//            "en"=>"Customer Name",
//            "ar"=>"إسم العميل",
//            "hi"=>"ग्राहक का नाम",
//        ],
//        "txt_address"=>[
//            "en"=>"Address",
//            "ar"=>"العنوان",
//            "hi"=>"पता",
//        ],
//        "txt_waiter"=>[
//            "en"=>"Waiter",
//            "ar"=>"ويتر",
//            "hi"=>"वेटर",
//        ],
//        "txt_item_details"=>[
//            "en"=>"Item Details",
//            "ar"=>"تفاصيل المنتج",
//            "hi"=>"आइटम विवरण",
//        ],
//        "txt_item_qty"=>[
//            "en"=>"Item Qty",
//            "ar"=>"كمية المنتج",
//            "hi"=>"आइटम मात्रा",
//        ],
//        "txt_item_price"=>[
//            "en"=>"Item Price",
//            "ar"=>"سعر المنتج",
//            "hi"=>"सामान की क़ीमत",
//        ],
//        "txt_amount"=>[
//            "en"=>"Amount",
//            "ar"=>"كمية",
//            "hi"=>"रकम",
//        ],
//        "txt_no_orders"=>[
//            "en"=>"No Orders",
//            "ar"=>"لا توجد طلبات",
//            "hi"=>"कोई ऑर्डर नहीं",
//        ],
//        "txt_discount"=>[
//            "en"=>"Discount",
//            "ar"=>"خصم",
//            "hi"=>"छूट",
//        ],
//        "txt_total_amount"=>[
//            "en"=>"Total Amount",
//            "ar"=>"الإجمالي",
//            "hi"=>"कुल रकम",
//        ],
//
//        "txt_subtotal"=>[
//            "en"=>"Subtotal",
//            "ar"=>"المبلغ النهائي",
//            "hi"=>"उपयोग",
//        ],
//
//        "txt_total"=>[
//            "en"=>"Total",
//            "ar"=>"المجموع",
//            "hi"=>"संपूर्ण",
//        ],
//        "txt_grand_total"=>[
//            "en"=>"Grand Total",
//            "ar"=>"المجموع الكلي",
//            "hi"=>"कुल योग",
//        ],
//        "txt_amount_words"=>[
//            "en"=>"Amount in Words",
//            "ar"=>"الكمية بالتعبير",
//            "hi"=>"राशि शब्दों में",
//        ],
//        "txt_customer_sign"=>[
//            "en"=>"Customer Signature",
//            "ar"=>"توقيع العميل",
//            "hi"=>"ग्राहक के हस्ताक्षर",
//        ],
//        "txt_manager_sign"=>[
//            "en"=>"Manager Signature",
//            "ar"=>"توقيع المدير",
//            "hi"=>"प्रबंधक के हस्ताक्षर",
//        ],
//        "txt_num_of_persons"=>[
//            "en"=>"No. of Persons",
//            "ar"=>"عدد الأشخاص",
//            "hi"=>"व्यक्तियों की संख्या",
//        ],
//        "txt_waiter_name"=>[
//            "en"=>"Waiter Name",
//            "ar"=>"إسم الموظف",
//            "hi"=>"वेटर का नाम",
//        ],
//        "txt_payment_mode"=>[
//            "en"=>"Payment Mode",
//            "ar"=>"طريقة الدفع",
//            "hi"=>"भुगतान का प्रकार",
//        ],
//        "txt_payment_status"=>[
//            "en"=>"Payment Status",
//            "ar"=>"حالة الدفع",
//            "hi"=>"भुगतान की स्थिति",
//        ],
//        "txt_inv_applicable"=>[
//            "en"=>"Invoice Applicable",
//            "ar"=>"الفاتورةالمطبقة",
//            "hi"=>"चालान लागू",
//        ],
//        "txt_website"=>[
//            "en"=>"Website",
//            "ar"=>"الموقع",
//            "hi"=>"वेबसाइट",
//        ],
//        "txt_bill_to"=>[
//            "en"=>"Bill To",
//            "ar"=>"فاتورة لـ",
//            "hi"=>"बिल प्राप्तकर्ता",
//        ],
//        "txt_orderd_items"=>[
//            "en"=>"Ordered Items",
//            "ar"=>"المنتجات المطلوبة",
//            "hi"=>"आइटम ऑर्डर किए गए",
//        ],
//        "txt_token_num"=>[
//            "en"=>"KOT No.",
//            "ar"=>"رقم KOT.",
//            "hi"=>"टोकन नंबर",
//        ],
//        "txt_type"=>[
//            "en"=>"Type",
//            "ar"=>"النوع",
//            "hi"=>"प्रकार",
//        ],
//        "txt_date_from"=>[
//            "en"=>"Date From",
//            "ar"=>"تاريخ من",
//            "hi"=>"तारीख से",
//        ],
//        "txt_date_to"=>[
//            "en"=>"Date To",
//            "ar"=>"تاريخ إلى",
//            "hi"=>"की तारीख",
//        ],
//        "txt_order_by"=>[
//            "en"=>"Order By",
//            "ar"=>"ترتيب ب",
//            "hi"=>"द्वारा ऑर्डर",
//        ],
//        "txt_inv_num"=>[
//            "en"=>"Invoice No.",
//            "ar"=>"رقم الفاتورة.",
//            "hi"=>"रसीद संख्या",
//        ],
//        "txt_tbl_room_num"=>[
//            "en"=>"Table/Room No.",
//            "ar"=>"رقم الغرفة/الطاولة.",
//            "hi"=>"टेबल / कमरा नं",
//        ],
//        "txt_order_date"=>[
//            "en"=>"Order Date",
//            "ar"=>"تاريخ الطلب",
//            "hi"=>"ऑर्डर की तारीख",
//        ],
//        "txt_pay_date"=>[
//            "en"=>"Pay Date",
//            "ar"=>"تاريخ الدفع",
//            "hi"=>"भुगतान की तिथि",
//        ],
//        "txt_order_list"=>[
//            "en"=>"Order List",
//            "ar"=>"قائمة الطلبات",
//            "hi"=>"ऑर्डर सूची",
//        ],
//        "txt_room_order"=>[
//            "en"=>"Room Order",
//            "ar"=>"ترتيب الغرف",
//            "hi"=>"कक्ष ऑर्डर",
//        ],
//        "txt_tbl_order"=>[
//            "en"=>"Table Order",
//            "ar"=>"ترتيب الطاولة",
//            "hi"=>"टेबल ऑर्डर",
//        ],
//        "txt_curr_stock"=>[
//            "en"=>"Current Stock",
//            "ar"=>"مخزون الحالية",
//            "hi"=>"वर्तमान स्टॉक",
//        ],
//        "txt_product_name"=>[
//            "en"=>"Product Name",
//            "ar"=>"إسم المنتج",
//            "hi"=>"उत्पाद का नाम",
//        ],
//        "txt_qty"=>[
//            "en"=>"Quantity",
//            "ar"=>"الكمية",
//            "hi"=>"मात्रा",
//        ],
//        "txt_currency"=>[
//            "en"=>"Currency",
//            "ar"=>"العملة",
//            "hi"=>"मुद्रा",
//        ],
//        "txt_currency_symbol"=>[
//            "en"=>"Currency Symbol",
//            "ar"=>"شعار العملة",
//            "hi"=>"मुद्रा चिन्ह",
//        ],
//        "txt_api_url"=>[
//            "en"=>"Api URL",
//            "ar"=>"Api رابط",
//            "hi"=>"एपीआई URL",
//        ],
//        "txt_api_username"=>[
//            "en"=>"Username",
//            "ar"=>"إسم المستخدم",
//            "hi"=>"उपयोगकर्ता नाम",
//        ],
//        "txt_api_senderid"=>[
//            "en"=>"Sender Id",
//            "ar"=>"رقم المرسل",
//            "hi"=>"प्रेषक आईडी",
//        ],
//        "txt_api_key"=>[
//            "en"=>"Api Key",
//            "ar"=>"Api مفتاح",
//            "hi"=>"एपीआई Key",
//        ],
//        "txt_api_active"=>[
//            "en"=>"Api Active",
//            "ar"=>"Api مفعل",
//            "hi"=>"एपीआई सक्रिय",
//        ],
//        "txt_email"=>[
//            "en"=>"E-mail",
//            "ar"=>"الإيميل",
//            "hi"=>"ईमेल",
//        ],
//        "txt_permission"=>[
//            "en"=>"Permission",
//            "ar"=>"الصلاحية",
//            "hi"=>"अनुमति",
//        ],
//        "txt_superadmin"=>[
//            "en"=>"Super Admin",
//            "ar"=>"المدير العام",
//            "hi"=>"सुपर एडमिन",
//        ],
//        "txt_admin"=>[
//            "en"=>"Admin",
//            "ar"=>"المدير",
//            "hi"=>"एडमिन",
//        ],
//        "txt_receptionist"=>[
//            "en"=>"Receptionist",
//            "ar"=>"الإستقبال",
//            "hi"=>"रिसेप्शनिस्ट",
//        ],
//        "txt_store_manager"=>[
//            "en"=>"Store Manager",
//            "ar"=>"مدير المخزن",
//            "hi"=>"स्टोर प्रबंधक",
//        ],
//        "txt_financial_manager"=>[
//            "en"=>"Financial Manager",
//            "ar"=>"مدير الحسابات",
//            "hi"=>"वित्तीय प्रबंधक",
//        ],
//        "txt_advance_payment"=>[
//            "en"=>"Advance Payment",
//            "ar"=>"دفع مقدم",
//            "hi"=>"अग्रिम भुगतान",
//        ],
//        "txt_age"=>[
//            "en"=>"Age",
//            "ar"=>"العمر",
//            "hi"=>"आयु",
//        ],
//        "txt_gender"=>[
//            "en"=>"Gender",
//            "ar"=>"الجنس",
//            "hi"=>"लिंग",
//        ],
//        "txt_type_id"=>[
//            "en"=>"Type of ID",
//            "ar"=>"نوع الهوية",
//            "hi"=>"आईडी का प्रकार",
//        ],
//        "txt_id_number"=>[
//            "en"=>"ID No.",
//            "ar"=>"رقم الهوية.",
//            "hi"=>"पहचान संख्या",
//        ],
//        "txt_upload_idcard"=>[
//            "en"=>"Upload ID Card",
//            "ar"=>"إرفع صورة الهوية",
//            "hi"=>"आईडी कार्ड अपलोड करें",
//        ],
//        "txt_multiple"=>[
//            "en"=>"Multiple",
//            "ar"=>"متعدد",
//            "hi"=>"विभिन्न",
//        ],
//        "txt_adults"=>[
//            "en"=>"Adults",
//            "ar"=>"بالغ",
//            "hi"=>"वयस्क",
//        ],
//        "txt_kids"=>[
//            "en"=>"Kids",
//            "ar"=>"طفل",
//            "hi"=>"बच्चे",
//        ],
//        "txt_purpose_of_the_visiting"=>[
//            "en"=>"Purpose of the visiting",
//            "ar"=>"سبب الزيارة",
//            "hi"=>"Purpose of the visiting",
//        ],
//        "txt_booked_by"=>[
//            "en"=>"Booked By",
//            "ar"=>"تم الحجز بواسطة",
//            "hi"=>"द्वारा बुक किया",
//        ],
//        "txt_vehicle_number"=>[
//            "en"=>"Vehicle Number",
//            "ar"=>"رقم السيارة",
//            "hi"=>"गाडी नंबर",
//        ],
//        "txt_referred_by"=>[
//            "en"=>"Referred By",
//            "ar"=>"المصدر",
//            "hi"=>"द्वारा उल्लिखित",
//        ],
//        "txt_referred_by_name"=>[
//            "en"=>"Referred By Name",
//            "ar"=>"إسم المصدر",
//            "hi"=>"नाम से संदर्भित",
//        ],
//        "txt_reason_of_visit"=>[
//            "en"=>"Reason of Visit/Stay",
//            "ar"=>"سبب الزيارة",
//            "hi"=>"यात्रा/रहने का कारण",
//        ],
//        "txt_remark_amount"=>[
//            "en"=>"Remark Amount",
//            "ar"=>"قيمة الملاحظة",
//            "hi"=>"रिमार्क राशि",
//        ],
//        "txt_remark"=>[
//            "en"=>"Remark",
//            "ar"=>"الملاحظة",
//            "hi"=>"टिप्पणी",
//        ],
//        "txt_select"=>[
//            "en"=>"Select",
//            "ar"=>"إختر",
//            "hi"=>"चयन",
//        ],
//        "txt_select_rooms"=>[
//            "en"=>"Select Rooms",
//            "ar"=>"إختر الغرف",
//            "hi"=>"कमरे का चयन",
//        ],
//        "txt_room_type"=>[
//            "en"=>"Room Type",
//            "ar"=>"نوع الشقة",
//            "hi"=>"कक्ष के प्रकार",
//        ],
//        "txt_duration_of_stay"=>[
//            "en"=>"Duration of Stay",
//            "ar"=>"مدة البقاء",
//            "hi"=>"रहने की अवधि",
//        ],
//        "txt_checkout"=>[
//            "en"=>"Check Out",
//            "ar"=>"تسجيل مغادرة",
//            "hi"=>"चेक आउट",
//        ],
//        "txt_checkin"=>[
//            "en"=>"Check In",
//            "ar"=>"تسجيل دخول",
//            "hi"=>"चेक इन",
//        ],
//        "txt_guest"=>[
//            "en"=>"Guest",
//            "ar"=>"النزيل",
//            "hi"=>"मेहमान",
//        ],
//        "txt_new_guest"=>[
//            "en"=>"New Guest",
//            "ar"=>"نزيل جديد",
//            "hi"=>"नए मेहमान",
//        ],
//        "txt_existing_guest"=>[
//            "en"=>"Existing Guest",
//            "ar"=>"نزيل سابق",
//            "hi"=>"मौजूदा अतिथि",
//        ],
//        "txt_guest_name"=>[
//            "en"=>"Guest Name",
//            "ar"=>"إسم النزيل",
//            "hi"=>"मेहमान का नाम",
//        ],
//        "txt_room"=>[
//            "en"=>"Room",
//            "ar"=>"الغرفة",
//            "hi"=>"कक्ष",
//        ],
//        "txt_final_amount"=>[
//            "en"=>"Final Amount",
//            "ar"=>"المبلغ النهائي",
//            "hi"=>"अंतिम राशी",
//        ],
//        "txt_no_record"=>[
//            "en"=>"No Records",
//            "ar"=>"لا يوجد تسجيلات",
//            "hi"=>"कोई रिकॉर्ड नहीं",
//        ],
//        "txt_food_orders"=>[
//            "en"=>"Food Orders",
//            "ar"=>"طلبات الطعام",
//            "hi"=>"खाद्य आदेश",
//        ],
//        "txt_advance_amount"=>[
//            "en"=>"Advance Amount",
//            "ar"=>"مدفوع مقدم",
//            "hi"=>"अग्रिम राशि",
//        ],
//        "txt_base_price"=>[
//            "en"=>"Base Price",
//            "ar"=>"السعر الأساسي",
//            "hi"=>"आधार मूल्य",
//        ],
//        "txt_room_qty"=>[
//            "en"=>"Room Qty",
//            "ar"=>"عدد الغرف",
//            "hi"=>"कक्ष मात्रा",
//        ],
//        "txt_no_file"=>[
//            "en"=>"No Files Uploaded",
//            "ar"=>"لا توجد ملفات مرفوعة",
//            "hi"=>"कोई फ़ाइल अपलोड नहीं की गई",
//        ],
//        "txt_idcard"=>[
//            "en"=>"Id Card",
//            "ar"=>"الهوية",
//            "hi"=>"आईडी कार्ड",
//        ],
//        "txt_idcard_uploaded"=>[
//            "en"=>"Uploaded Id Cards",
//            "ar"=>"الهويات المرفوعة",
//            "hi"=>"अपलोड किए गए आईडी कार्ड",
//        ],
//        "txt_idcard_type"=>[
//            "en"=>"ID Card Type",
//            "ar"=>"نوع الهوية",
//            "hi"=>"आईडी कार्ड का प्रकार",
//        ],
//        "txt_idcard_num"=>[
//            "en"=>"ID Card Number",
//            "ar"=>"رقم الهوية",
//            "hi"=>"परिचय - पत्र संख्या",
//        ],
//        "txt_company_gst_num"=>[
//            "en"=>"Company Tax No.",
//            "ar"=>"رقم ضريبة الشركة.",
//            "hi"=>"कंपनी जीएसटी नं.",
//        ],
//        "txt_persons"=>[
//            "en"=>"Person`s",
//            "ar"=>"الأشخاص",
//            "hi"=>"व्यक्ति",
//        ],
//        "txt_checkin_from_date"=>[
//            "en"=>"Check In Form Date",
//            "ar"=>"تاريخ تسجيل دخول",
//            "hi"=>"चेक-इन फॉर्म की तारीख",
//        ],
//        "txt_checkout_from_date"=>[
//            "en"=>"Check Out Form Date",
//            "ar"=>"تاريخ المغادرة",
//            "hi"=>"चेक-आउट फॉर्म की तारीख",
//        ],
//        "txt_years"=>[
//            "en"=>"Years",
//            "ar"=>"السنوات",
//            "hi"=>"वर्ष",
//        ],
//        "txt_yes"=>[
//            "en"=>"Yes",
//            "ar"=>"نعم",
//            "hi"=>"Yes",
//        ],
//        "txt_no"=>[
//            "en"=>"No",
//            "ar"=>"لا",
//            "hi"=>"No",
//        ],
//        "txt_uploaded_files"=>[
//            "en"=>"Uploaded Files",
//            "ar"=>"الملفات المرفوعة",
//            "hi"=>"अपलोड की गई फाइलें",
//        ],
//        "txt_user"=>[
//            "en"=>"User",
//            "ar"=>"المستخدم",
//            "hi"=>"उपयोगकर्ता",
//        ],
//        "txt_password"=>[
//            "en"=>"Password",
//            "ar"=>"الرقم السري",
//            "hi"=>"पासवर्ड",
//        ],
//        "txt_password_new"=>[
//            "en"=>"New Password",
//            "ar"=>"رقم سري جديد",
//            "hi"=>"नया पासवर्ड",
//        ],
//        "txt_password_conf"=>[
//            "en"=>"Confirm Password",
//            "ar"=>"تأكيد الرقم السري",
//            "hi"=>"पासवर्ड की पुष्टि",
//        ],
//        "txt_user_role"=>[
//            "en"=>"User Role",
//            "ar"=>"دور المستخدم",
//            "hi"=>"उपयोगकर्ता भूमिका",
//        ],
//        "txt_role"=>[
//            "en"=>"Role",
//            "ar"=>"الدور",
//            "hi"=>"भूमिका",
//        ],
//        "txt_description"=>[
//            "en"=>"Description",
//            "ar"=>"التفاصيل",
//            "hi"=>"विवरण",
//        ],
//        "txt_amenities"=>[
//            "en"=>"Amenities",
//            "ar"=>"الكماليات",
//            "hi"=>"सुविधाएँ",
//        ],
//        "txt_list_amenities"=>[
//            "en"=>"List Amenities",
//            "ar"=>"قائمة الكماليات",
//            "hi"=>"सुविधाओं की सूची",
//        ],
//        "txt_floor"=>[
//            "en"=>"Floor",
//            "ar"=>"الدور",
//            "hi"=>"मंज़िल",
//        ],
//        "txt_list_room"=>[
//            "en"=>"List Rooms",
//            "ar"=>"قائمة الغرف",
//            "hi"=>"कमरों की सूची",
//        ],
//        "txt_title"=>[
//            "en"=>"Title",
//            "ar"=>"العنوان",
//            "hi"=>"शीर्षक",
//        ],
//        "txt_short_code"=>[
//            "en"=>"Short Code",
//            "ar"=>"كود مختصر",
//            "hi"=>"छोटा संकेत",
//        ],
//        "txt_adult_capacity"=>[
//            "en"=>"Adult Capacity",
//            "ar"=>"سعة للكبار",
//            "hi"=>"वयस्क क्षमता",
//        ],
//        "txt_kids_capacity"=>[
//            "en"=>"Kids Capacity",
//            "ar"=>"سعة الأطفال",
//            "hi"=>"बच्चों की क्षमता",
//        ],
//        "txt_capacity"=>[
//            "en"=>"Capacity",
//            "ar"=>"السعة",
//            "hi"=>"क्षमता",
//        ],
//        "txt_by"=>[
//            "en"=>"By",
//            "ar"=>"بواسطة",
//            "hi"=>"द्वारा",
//        ],
//        "txt_customer"=>[
//            "en"=>"Customer",
//            "ar"=>"العميل",
//            "hi"=>"ग्राहक",
//        ],
//        "txt_list_users"=>[
//            "en"=>"List Users",
//            "ar"=>"قائمة المسجلين",
//            "hi"=>"उपयोगकर्ता सूची",
//        ],
//        "txt_list_customers"=>[
//            "en"=>"List Customers",
//            "ar"=>"قائمة العملاء",
//            "hi"=>"ग्राहकों की सूची",
//        ],
//        "txt_invoice_tnc"=>[
//            "en"=>"Invoice Term & Conditions",
//            "ar"=>"شروط أحكام الفاتورة",
//            "hi"=>"रसीद नियम और शर्तें",
//        ],
//        "txt_attachment"=>[
//            "en"=>"Attachment",
//            "ar"=>"المرفقات",
//            "hi"=>"रसीदें",
//        ],
//        "txt_available"=>[
//            "en"=>"Available",
//            "ar"=>"متوفر",
//            "hi"=>"उपलब्ध",
//        ],
//        "txt_booked"=>[
//            "en"=>"Booked",
//            "ar"=>"تم الحجز",
//            "hi"=>"बुक किया",
//        ],
//        "txt_no_rooms"=>[
//            "en"=>"No Rooms: ",
//            "ar"=>"لاتوجد غرف: ",
//            "hi"=>"कोई कमरा नहीं",
//        ],
//        "txt_add_new_rooms"=>[
//            "en"=>"Add New",
//            "ar"=>"إضافة جديد",
//            "hi"=>"नया कक्ष जोड़ें",
//        ],
//        "txt_company_name"=>[
//            "en"=>"Company Name",
//            "ar"=>"إسم الشركة",
//            "hi"=>"कंपनी का नाम",
//        ],
//        "txt_room_plan"=>[
//            "en"=>"Room Plan",
//            "ar"=>"خطة الشقق",
//            "hi"=>"कक्ष योजना",
//        ],
//        "txt_heading_select_rooms"=>[
//            "en"=>"Select Rooms",
//            "ar"=>"إختر الغرف",
//            "hi"=>"कमरे चुनें",
//        ],
//        "txt_heading_select_room_for_swap"=>[
//            "en"=>"Select Room For Swap",
//            "ar"=>"إختر الغرفة للتبديل",
//            "hi"=>"स्वैप के लिए कक्ष चुनें",
//        ],
//        "txt_swapped_room"=>[
//            "en"=>"Swapped Room",
//            "ar"=>"تبديل الغرفة",
//            "hi"=>"अदला-बदली कक्ष",
//        ],
//        "txt_heading_booked_rooms"=>[
//            "en"=>"Booked Rooms",
//            "ar"=>"الغرفة محجوزة",
//            "hi"=>"बुक किए गए कमरे",
//        ],
//        "txt_dropdown_values"=>[
//            "en"=>"Dropdown Values",
//            "ar"=>"قيم القائمة",
//            "hi"=>"ड्रॉपडाउन मान",
//        ],
//        "txt_dropdown_gender"=>[
//            "en"=>"Gender Dropdown",
//            "ar"=>"قائمة الجنس",
//            "hi"=>"जेंडर ड्रॉपडाउन",
//        ],
//        "txt_dropdown_type_of_ids"=>[
//            "en"=>"Type of Ids Dropdown",
//            "ar"=>"أنواع الهويات",
//            "hi"=>"आईडी ड्रॉपडाउन का प्रकार",
//        ],
//        "txt_dropdown_room_floor"=>[
//            "en"=>"Room Floor Dropdowns",
//            "ar"=>"قائمة أدوار الغرف",
//            "hi"=>"रूम फ्लोर ड्रॉपडाउन",
//        ],
//
//
//
//        "txt_dropdown_measurement"=>[
//            "en"=>"Measurement Dropdowns",
//            "ar"=>"قائمة الوحدات",
//            "hi"=>"मापन ड्रॉपडाउन",
//        ],
//        "txt_default_rec_days"=>[
//            "en"=>"Default Filter Dates Range (Days)",
//            "ar"=>"نطاق التواريخ للتصفية الاإفتراضية (الايام)",
//            "hi"=>"डिफ़ॉल्ट फ़िल्टर दिनांक सीमा (दिन)",
//        ],
//        "txt_site_logo"=>[
//            "en"=>"Site Logo",
//            "ar"=>"شعار الموقع",
//            "hi"=>"साइट लोगो",
//        ],
//        "txt_site_logo_width"=>[
//            "en"=>"Logo Width (px)",
//            "ar"=>"عرض اللوقو (px)",
//            "hi"=>"लोगो की चौड़ाई (px)",
//        ],
//        "txt_site_logo_height"=>[
//            "en"=>"Logo Height (px)",
//            "ar"=>"طول اللوقو (px)",
//            "hi"=>"लोगो की ऊंचाई (px)",
//        ],
//        "txt_bank_name"=>[
//            "en"=>"Bank Name",
//            "ar"=>"إسم البنك",
//            "hi"=>"बैंक का नाम",
//        ],
//        "txt_bank_ifsc_code"=>[
//            "en"=>"IFSC Code",
//            "ar"=>"IFSC كود",
//            "hi"=>"आईएफएससी कोड",
//        ],
//        "txt_bank_acc_name"=>[
//            "en"=>"Account Name",
//            "ar"=>"إسم الحساب",
//            "hi"=>"खाता नाम",
//        ],
//        "txt_bank_acc_num"=>[
//            "en"=>"Account No.",
//            "ar"=>"رقم الحساب.",
//            "hi"=>"खाता नंबर",
//        ],
//        "txt_bank_branch"=>[
//            "en"=>"Bank & Branch",
//            "ar"=>"البنك و الفرع",
//            "hi"=>"बैंक शाखा",
//        ],
//        "txt_additional_amount"=>[
//            "en"=>"Additional Amount",
//            "ar"=>"مبالغ إضافية",
//            "hi"=>"अतिरिक्त राशि",
//        ],
//        "txt_additional_amount_reason"=>[
//            "en"=>"Reason of Additional Amount",
//            "ar"=>"سبب المبلغ الإضافي",
//            "hi"=>"अतिरिक्त राशि का कारण",
//        ],
//        "txt_order_num"=>[
//            "en"=>"Order",
//            "ar"=>"طلب",
//            "hi"=>"आदेश",
//        ],
//        "txt_images"=>[
//            "en"=>"Image",
//            "ar"=>"الصورة",
//            "hi"=>"छवि",
//        ],
//        "txt_firstname"=>[
//            "en"=>"First Name",
//            "ar"=>"اسم الأول",
//            "hi"=>"पहला नाम",
//        ],
//        "txt_middlename"=>[
//            "en"=>"Middle Name",
//            "ar"=>"اسم الوسط",
//            "hi"=>"मध्य नाम",
//        ],
//        "txt_surname"=>[
//            "en"=>"Surname",
//            "ar"=>"اسم الأخير",
//            "hi"=>"उपनाम",
//        ],
//        "txt_section_1"=>[
//            "en"=>"Section 1",
//            "ar"=>"قسم ١",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_2"=>[
//            "en"=>"Section 2",
//            "ar"=>"قسم ٢",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_3"=>[
//            "en"=>"Section 3",
//            "ar"=>"قسم ٣",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_4"=>[
//            "en"=>"Section 4",
//            "ar"=>"قسم ٤",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_5"=>[
//            "en"=>"Section 5",
//            "ar"=>"قسم ٥",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_6"=>[
//            "en"=>"Section 6",
//            "ar"=>"قسم ٦",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_7"=>[
//            "en"=>"Section 7",
//            "ar"=>"قسم ٧",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_8"=>[
//            "en"=>"Section 8",
//            "ar"=>"قسم ٨",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_9"=>[
//            "en"=>"Section 9",
//            "ar"=>"قسم ٩",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_section_10"=>[
//            "en"=>"Section 10",
//            "ar"=>"قسم ١٠",
//            "hi"=>"अनुभाग",
//        ],
//        "txt_banner_title"=>[
//            "en"=>"Banner Title",
//            "ar"=>"عنوان البنر",
//            "hi"=>"बैनर शीर्षक",
//        ],
//        "txt_banner_subtitle"=>[
//            "en"=>"Banner Subtitle",
//            "ar"=>"عنوان الفرعي للبنر",
//            "hi"=>"बैनर उपशीर्षक",
//        ],
//        "txt_checkin_report"=>[
//            "en"=>"Check-Ins Reports",
//            "ar"=>"تقرير تسجيل الدخول",
//            "hi"=>"चेक-इन रिपोर्ट",
//        ],
//        "txt_checkout_report"=>[
//            "en"=>"Check-Outs Report",
//            "ar"=>"تقرير تسجيل المغادرة",
//            "hi"=>"चेक-आउट रिपोर्ट",
//        ],
//        "txt_sales_report"=>[
//            "en"=>"Sales Report",
//            "ar"=>"تقرير المبيعات",
//            "hi"=>"बिक्री रिपोर्ट",
//        ],
//        "txt_expense_report"=>[
//            "en"=>"Expense Report",
//            "ar"=>"تقرير المصاريف",
//            "hi"=>"खर्च रिपोर्ट्",
//        ],
//        "txt_transactions_report"=>[
//            "en"=>"Transactions Report",
//            "ar"=>"تقرير التحويلات",
//            "hi"=>"लेनदेन रिपोर्ट",
//        ],
//        "txt_total_income"=>[
//            "en"=>"Total Income",
//            "ar"=>"مجموع العوائد",
//            "hi"=>"कुल आय",
//        ],
//        "txt_total_expense"=>[
//            "en"=>"Total Expense",
//            "ar"=>"مجموع المصاريف",
//            "hi"=>"कुल खर्च",
//        ],
//        "txt_total_netamount"=>[
//            "en"=>"Net Amount",
//            "ar"=>"الكمية الإجمالية",
//            "hi"=>"शुद्ध राशि",
//        ],
//        "txt_activity"=>[
//            "en"=>"Activity",
//            "ar"=>"النشاط",
//            "hi"=>"गतिविधि",
//        ],
//        "txt_transaction_id"=>[
//            "en"=>"Transaction Id",
//            "ar"=>"رقم التحويل",
//            "hi"=>"लेन-देन आईडी",
//        ],
//        "txt_user_name"=>[
//            "en"=>"User Name",
//            "ar"=>"إسم المستخدم",
//            "hi"=>"उपयोगकर्ता नाम",
//        ],
//        "txt_develop_by"=>[
//            "en"=>"2022 Designd & Develop By Divllo. All Rights Reserved",
//            "ar"=>"تم التطوير بواسطة ديفلو، جميع الحقوق محفوظة 2022",
//            "hi"=>"2022 Designd & Develop By Divllo. All Rights Reserved",
//        ],
//
//
//
//
//
//
//        "ntmp_api_key"=>[
//            "en"=>"NTMP Api Key",
//            "ar"=>"مفتاح الخاص لمنصة السياحة",
//            "hi"=>"NTMP Api Key",
//        ],
//        "ntmp_user_id"=>[
//            "en"=>"NTMP UserID",
//            "ar"=>"إسم المستخدم لمنصة السياحة",
//            "hi"=>"NTMP UserID",
//        ],
//        "ntmp_password"=>[
//            "en"=>"NTMP Password",
//            "ar"=>"رقم السري لمنصة السياحة",
//            "hi"=>"NTMP Password",
//        ],
//        "ntmp_type"=>[
//            "en"=>"NTMP Type",
//            "ar"=>"النوع لمنصة السياحة",
//            "hi"=>"NTMP Type",
//        ],
//        "ntmp_status"=>[
//            "en"=>"NTMP Status",
//            "ar"=>"الحالة لمنصة السياحة",
//            "hi"=>"NTMP Status",
//        ],
//        "booking_is_cancelled"=>[
//            "en"=>"Booking is canceled",
//            "ar"=>"تم إلغاء الحجز",
//            "hi"=>"चेक आउट",
//        ],
//        "btn_cancel_booking"=>[
//            "en"=>"Cancel Booking",
//            "ar"=>"إلغاء الحجز",
//            "hi"=>"चेक आउट",
//        ],
//        "btn_check_in"=>[
//            "en"=>"Booking change to checkin",
//            "ar"=>"تغيير الحجز إلى دخول",
//            "hi"=>"Booking change to checkin",
//        ],
//        "txt_reservation_type"=>[
//            "en"=>"Reservation Type",
//            "ar"=>"نوع الحجز",
//            "hi"=>"Reservation Type",
//        ],
//        "txt_due_amount"=>[
//            "en"=>"Due Amount",
//            "ar"=>"القيمة المتبقية",
//            "hi"=>"Due Amount",
//        ],
//        "txt_please_wait"=>[
//            "en"=>"Please Wait",
//            "ar"=>"يرجى الانتظار",
//            "hi"=>"Please Wait",
//        ],
//
//
//        "txt_dropdown_reason_of_visit"=>[
//            "en"=>"Reason of visit",
//            "ar"=>"سبب الزيارة",
//            "hi"=>"Reason of visit",
//        ],
//        "txt_dropdown_payment_type"=>[
//            "en"=>"Payment Mode",
//            "ar"=>"حالة الدفع",
//            "hi"=>"Payment Mode",
//        ],
//        "txt_dropdown_customer_types"=>[
//            "en"=>"Customer Type",
//            "ar"=>"نوع العميل",
//            "hi"=>"Customer Type",
//        ],
//        "txt_dropdown_room_types"=>[
//            "en"=>"Room Type",
//            "ar"=>"نوع الغرفة",
//            "hi"=>"Room Type",
//        ],
//        "txt_dropdown_room_rent_type"=>[
//            "en"=>"Room Rent Type",
//            "ar"=>"نوع إيجار الغرفة",
//            "hi"=>"Room Rent Type",
//        ],
//        "txt_dropdown_transaction_type_id"=>[
//            "en"=>"Transaction Type",
//            "ar"=>"نوع التحويل",
//            "hi"=>"Transaction Type",
//        ],
//        "txt_dropdown_nationalities"=>[
//            "en"=>"Nationalities",
//            "ar"=>"الجنسيات",
//            "hi"=>"Nationalities",
//        ],
//        "txt_nationality"=>[
//            "en"=>"Nationality",
//            "ar"=>"الجنسية",
//            "hi"=>"Nationality",
//        ],
//        "txt_room_rent_type"=>[
//            "en"=>"Room Rent Type",
//            "ar"=>"نوع إيجار الغرفة",
//            "hi"=>"Room Rent Type",
//        ],
//        "txt_transaction_type"=>[
//            "en"=>"Transaction Type",
//            "ar"=>"نوع التحويل",
//            "hi"=>"Transaction Type",
//        ],
//        "txt_customer_types"=>[
//            "en"=>"Customer Type",
//            "ar"=>"نوع العميل",
//            "hi"=>"Customer Type",
//        ],
//        "txt_payment_type"=>[
//            "en"=>"Payment Type",
//            "ar"=>"نوع الدفع",
//            "hi"=>"Payment Type",
//        ],
//        "ministory_of_tourism_section"=>[
//            "en"=>"Details Required for Ministory of Tourism",
//            "ar"=>"التفاصيل مطلوبة لوزارة السياحة",
//            "hi"=>"Details Required for Ministory of Tourism",
//        ],
//        "invoice_setting_for_english"=>[
//            "en"=>"Invoice label setting for english",
//            "ar"=>"إعدادات النصوص للفاتورة الانجليزية",
//            "hi"=>"Invoice label setting for english",
//        ],
//        "invoice_setting_for_arabic"=>[
//            "en"=>"Invoice label setting for arabic",
//            "ar"=>"إعدادات النصوص للفاتورة العربية",
//            "hi"=>"Invoice label setting for arabic",
//        ],
//        "txt_invoice_lang"=>[
//            "en"=>"Invoice language",
//            "ar"=>"لغة الفاتورة",
//            "hi"=>"Invoice language",
//        ],
//        "txt_invoice_and_slip_lang"=>[
//            "en"=>"Invoice and Advance Slip language",
//            "ar"=>"لغة الفاتورة وسند الدفع المقدم",
//            "hi"=>"Invoice and Advance Slip language",
//        ],
//        "inv_invoice_page_label"=>[
//            "en"=>"invoice page label",
//            "ar"=>"نص صفحة الفاتورة",
//            "hi"=>"invoice page label",
//        ],
//        "inv_invoice_name_for_original"=>[
//            "en"=>"invoice name for original label",
//            "ar"=>"نص لاسم الفاتورة الاصلية",
//            "hi"=>"invoice name for original label",
//        ],
//        "inv_invoice_name_for_duplicate"=>[
//            "en"=>"invoice name for duplicate label",
//            "ar"=>"نص لاسم نسخة الفاتورة",
//            "hi"=>"invoice name for duplicate label",
//        ],
//        "inv_invoice_name_for_cancel"=>[
//            "en"=>"invoice name for cancel label",
//            "ar"=>"نص لاسم الفاتورة الملغية",
//            "hi"=>"invoice name for cancel label",
//        ],
//        "inv_tax_number"=>[
//            "en"=>"tax number label",
//            "ar"=>"نص الرقم الضريبي",
//            "hi"=>"tax number"
//        ],
//        "inv_tax_invoice"=>[
//            "en"=>"tax invoice label",
//            "ar"=>"نص الفاتورة الضريبية",
//            "hi"=>"tax invoice label",
//        ],
//        "inv_ph_landline"=>[
//            "en"=>"phone label",
//            "ar"=>"نص الهاتف",
//            "hi"=>"phone label",
//        ],
//        "inv_ph_mobile"=>[
//            "en"=>"mobile label",
//            "ar"=>"نص الجوال",
//            "hi"=>"mobile label",
//        ],
//        "inv_email"=>[
//            "en"=>"email label",
//            "ar"=>"نص الايميل",
//            "hi"=>"email label",
//        ],
//        "inv_invoice_no"=>[
//            "en"=>"invoice no label",
//            "ar"=>"نص رقم الفاتورة",
//            "hi"=>"invoice no label",
//        ],
//        "inv_invoice_date"=>[
//            "en"=>"invoice date label",
//            "ar"=>"نص تاريخ الفاتورة",
//            "hi"=>"invoice date label",
//        ],
//        "inv_customer_name"=>[
//            "en"=>"customer name label",
//            "ar"=>"نص اسم العميل",
//            "hi"=>"customer name label",
//        ],
//        "inv_customer_mobile"=>[
//            "en"=>"customer mobile label",
//            "ar"=>"نص جوال العميل",
//            "hi"=>"customer mobile label",
//        ],
//        "inv_company_name"=>[
//            "en"=>"company name label",
//            "ar"=>"نص اسم الشركة",
//            "hi"=>"company name label",
//        ],
//        "inv_address"=>[
//            "en"=>"address label",
//            "ar"=>"نص العنوان",
//            "hi"=>"address label",
//        ],
//        "inv_checkin"=>[
//            "en"=>"checkin label",
//            "ar"=>"نص تسجيل الدخول",
//            "hi"=>"checkin label",
//        ],
//        "inv_checkout"=>[
//            "en"=>"checkout label",
//            "ar"=>"نص تسجيل الخروج",
//            "hi"=>"checkout label",
//        ],
//        "inv_serial_no"=>[
//            "en"=>"serial no label",
//            "ar"=>"نص الرقم التسلسلي",
//            "hi"=>"serial no label",
//        ],
//        "inv_room_name_number"=>[
//            "en"=>"room name number label",
//            "ar"=>"نص اسم ورقم الغرفة",
//            "hi"=>"room name number label",
//        ],
//        "inv_total_days"=>[
//            "en"=>"total days label",
//            "ar"=>"نص إجمالي الايام",
//            "hi"=>"total days label",
//        ],
//        "inv_room_rent"=>[
//            "en"=>"room rent label",
//            "ar"=>"نص إيجار الغرفة",
//            "hi"=>"room rent label",
//        ],
//        "inv_amount"=>[
//            "en"=>"amount label",
//            "ar"=>"نص القيمة",
//            "hi"=>"amount label",
//        ],
//        "inv_total"=>[
//            "en"=>"total label",
//            "ar"=>"نص المجموع",
//            "hi"=>"total label",
//        ],
//        "inv_grand_total"=>[
//            "en"=>"grand total label",
//            "ar"=>"نص الاجمالي",
//            "hi"=>"grand total label",
//        ],
//        "inv_tax"=>[
//            "en"=>"tax label",
//            "ar"=>"نص الضريبة",
//            "hi"=>"tax label",
//        ],
//        "inv_c_tax"=>[
//            "en"=>"ctax label",
//            "ar"=>"نص ضريبة الإيواء",
//            "hi"=>"ctax label",
//        ],
//        "inv_discount"=>[
//            "en"=>"discount label",
//            "ar"=>"نص الخصم",
//            "hi"=>"discount label",
//        ],
//        "inv_subtotal"=>[
//            "en"=>"subtotal label",
//            "ar"=>"نص المجموع الكلي",
//            "hi"=>"subtotal label",
//        ],
//        "inv_advance_amount"=>[
//            "en"=>"advance amount label",
//            "ar"=>"نص قيمة الدفع المقدم",
//            "hi"=>"advance amount label",
//        ],
//        "inv_due_amount"=>[
//            "en"=>"due amount label",
//            "ar"=>"نص المبلغ المتبقي",
//            "hi"=>"due amount label",
//        ],
//        "inv_customer_balance"=>[
//            "en"=>"customer balance label",
//            "ar"=>"نص رصيد العميل",
//            "hi"=>"customer balance label",
//        ],
//        "inv_returned"=>[
//            "en"=>"returned label",
//            "ar"=>"نص المرتجع",
//            "hi"=>"returned label",
//        ],
//        "inv_refund_amount"=>[
//            "en"=>"refund amount label",
//            "ar"=>"نص القيمة المستردة",
//            "hi"=>"refund amount label",
//        ],
//        "inv_balance_amount"=>[
//            "en"=>"balance amount label",
//            "ar"=>"نص قيمة الرصيد",
//            "hi"=>"balance amount label",
//        ],
//        "inv_amount_in_words"=>[
//            "en"=>"amount in words label",
//            "ar"=>"نص المبلغ كتابيا",
//            "hi"=>"amount in words label",
//        ],
//        "inv_bank_details"=>[
//            "en"=>"bank details label",
//            "ar"=>"نص تفاصيل البنك",
//            "hi"=>"bank details label",
//        ],
//        "inv_acc_name"=>[
//            "en"=>"acc name label",
//            "ar"=>"نص اسم الحساب",
//            "hi"=>"acc name label",
//        ],
//        "inv_ifsc_code"=>[
//            "en"=>"IFSC Code label",
//            "ar"=>"IFSC كود نص",
//            "hi"=>"आईएफएससी कोड label",
//        ],
//        "inv_account_number"=>[
//            "en"=>"account number label",
//            "ar"=>"نص رقم الحساب",
//            "hi"=>"account number label",
//        ],
//        "inv_bank_and_branch"=>[
//            "en"=>"bank and branch label",
//            "ar"=>"نص البنك والفرع",
//            "hi"=>"bank and branch label",
//        ],
//        "inv_guest_sign"=>[
//            "en"=>"guest sign label",
//            "ar"=>"نص توقيع النزيل",
//            "hi"=>"guest sign label",
//        ],
//        "inv_cashier_sign"=>[
//            "en"=>"cashier sign label",
//            "ar"=>"نص توقيع الاستقبال",
//            "hi"=>"cashier sign label",
//        ],
//        "inv_terms_condition_heading"=>[
//            "en"=>"terms condition heading label",
//            "ar"=>"نص عنوان شروط والأحكام",
//            "hi"=>"terms condition heading label",
//        ],
//        "inv_terms_condition_descriptions"=>[
//            "en"=>"terms condition descriptions label",
//            "ar"=>"نص تفاصيل الشروط والاحكام",
//            "hi"=>"terms condition descriptions label",
//        ],
//        "inv_terms_condition_note"=>[
//            "en"=>"terms condition note label",
//            "ar"=>"نص شروط والاحكام",
//            "hi"=>"terms condition note label",
//        ],
//        "inv_food_item_details"=>[
//            "en"=>"for food item details label",
//            "ar"=>"نص تفاصيل عنصر الطعام",
//            "hi"=>"for food item details label",
//        ],
//        "inv_food_date"=>[
//            "en"=>"for food date label",
//            "ar"=>"نص تاريخ الطعام",
//            "hi"=>"for food date label",
//        ],
//        "inv_food_item_qty"=>[
//            "en"=>"for food item qty label",
//            "ar"=>"نص عدد الطعام",
//            "hi"=>"for food item qty label",
//        ],
//        "inv_food_item_price"=>[
//            "en"=>"for food item price label",
//            "ar"=>"نص سعر الطعام",
//            "hi"=>"for food item price label",
//        ],
//        "inv_food_amount"=>[
//            "en"=>"for food amount label",
//            "ar"=>"نص كمية الطعام",
//            "hi"=>"for food amount label",
//        ],
//        "inv_food_no_of_orders"=>[
//            "en"=>"for food no of orders label",
//            "ar"=>"نص لعدد طلبات الطعام",
//            "hi"=>"for food no of orders label",
//        ],
//        "inv_description"=>[
//            "en"=>"Description",
//            "ar"=>"الوصف",
//            "hi"=>"Description",
//        ],
//        "inv_advance_slip"=>[
//            "en"=>"Advance Slip",
//            "ar"=>"سند الدفع المقدم",
//            "hi"=>"Advance Slip",
//        ],
//        "btn_extend_reservation"=>[
//            "en"=>"Extend Reservation",
//            "ar"=>"تمديد الحجز",
//            "hi"=>"Advance Slip",
//        ],
//        "txt_days_type"=>[
//            "en"=>"Extend Reservation Day Type",
//            "ar"=>"تمديد نوع يوم الحجز",
//            "hi"=>"Advance Slip",
//        ],
//        "txt_extend"=>[
//            "en"=>"Extend",
//            "ar"=>"تمديد",
//            "hi"=>"Advance Slip",
//        ],
//        "txt_reduce"=>[
//            "en"=>"Reduce",
//            "ar"=>"خفض",
//            "hi"=>"Advance Slip",
//        ],
//        "txt_no_of_days"=>[
//            "en"=>"No of Days",
//            "ar"=>"لا أيام",
//            "hi"=>"Advance Slip",
//        ],
//        "heading_today_checkouts"=>[
//            "en"=>"Today's Checkouts",
//            "ar"=>"الخروج اليوم",
//            "hi"=>"Advance Slip",
//        ],
//        "heading_tommorow_checkouts"=>[
//            "en"=>"Tomorrow's Checkouts",
//            "ar"=>"الخروج غدا",
//            "hi"=>"Advance Slip",
//        ],
//
//
//
//        "txt_new_company"=>[
//            "en"=>"New Company",
//            "ar"=>"شركة جديدة",
//        ],
//        "txt_existing_company"=>[
//            "en"=>"Existing Company",
//            "ar"=>"الشركة القائمة",
//        ],
//        "txt_company"=>[
//            "en"=>"Company",
//            "ar"=>"شركة",
//        ],
//        "txt_company_email"=>[
//            "en"=>"Company Email",
//            "ar"=>"البريد الإلكتروني للشركة",
//        ],
//        "txt_company_mobile_num"=>[
//            "en"=>"Company Phone",
//            "ar"=>"هاتف الشركة",
//        ],
//        "txt_company_address"=>[
//            "en"=>"Company Address",
//            "ar"=>"عنوان الشركة",
//        ],
//        "txt_company_country"=>[
//            "en"=>"Company Country",
//            "ar"=>"بلد الشركة",
//        ],
//        "txt_company_state"=>[
//            "en"=>"Company State",
//            "ar"=>"دولة الشركة",
//        ],
//        "txt_company_city"=>[
//            "en"=>"Company City",
//            "ar"=>"مدينة الشركة",
//        ],
//
//        "txt_list_companys"=>[
//            "en"=>"Company List",
//            "ar"=>"قائمة الشركة",
//        ],
//        "heading_filter_company"=>[
//            "en"=>"Company Filter",
//            "ar"=>"مرشح الشركة",
//        ],
//        "sidemenu_companys"=>[
//            "en"=>"Companies",
//            "ar"=>"شركات",
//        ],
//        "sidemenu_company_add"=>[
//            "en"=>"Add Company",
//            "ar"=>"أضف شركة",
//        ],
//        "sidemenu_company_all"=>[
//            "en"=>"All Company",
//            "ar"=>"كل شركة",
//        ],
//        "heading_company_info"=>[
//            "en"=>"Company Information",
//            "ar"=>"معلومات الشركة",
//        ],
//        "heading_existing_company_list"=>[
//            "en"=>"Existing Company List",
//            "ar"=>"قائمة الشركات الحالية",
//        ],
//        "txt_reservations"=>[
//            "en"=>"Reservations",
//            "ar"=>"التحفظات",
//        ],
//        "txt_reservation"=>[
//            "en"=>"Reservation",
//            "ar"=>"تحفظ",
//        ],
//
//    ];
//    foreach($array as $k => $v){
//        \App\LanguageTranslation::updateOrCreate(['lang_key' => $k], [
//            'lang_key' => $k,
//            'en'=>$v['en'],
//            'ar'=>$v['ar'],
//        ]);
//    }
//});
Route::group(['prefix' => 'install'], function() {
	Route::get('/', ['uses' => 'InstallController@index'])->name('checklist');
	Route::get('set-database', ['uses' => 'InstallController@databaseView'])->name('set-database');
	Route::post('save-database', ['uses' => 'InstallController@databaseSave'])->name('save-database');

	Route::get('set-siteconfig', ['uses' => 'InstallController@siteconfigView'])->name('set-siteconfig');
	Route::post('save-siteconfig', ['uses' => 'InstallController@siteconfigSave'])->name('save-siteconfig');

	Route::get('done', ['uses' => 'InstallController@doneView'])->name('done');
});

//front routes
Route::get('sign-in', 'HomeController@signIn')->name('sign-in');
Route::post('do-sign-in', 'HomeController@doSignIn')->name('do-sign-in');
Route::get('sign-up', 'HomeController@signUp')->name('sign-up');
Route::post('do-sign-up', 'HomeController@doSignUp')->name('do-sign-up');
Route::get('logout', ['uses' => 'UserController@logout'])->name('user-logout');

Route::get('/', ['uses' => 'HomeController@index'])->name('home');
Route::get('/room-details/{id}', ['uses' => 'HomeController@roomDetails'])->name('room-details');
Route::get('advance-slip/{id}', ['uses' => 'HomeController@advanceRoomSlip'])->name('advance-slip');
Route::get('contact-us', ['uses' => 'HomeController@contactUs'])->name('contact-us');
Route::post('save-contact-message', 'HomeController@contactUsMessage')->name('save-contact-message');
Route::get('about-us', 'HomeController@aboutUs')->name('about-us');
Route::get('privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
Route::post('terms-conditions', 'HomeController@termsConditions')->name('terms-conditions');
Route::post('subscribe-notifivations', 'HomeController@subscribeNotifications')->name('subscribe-notifivations');
Route::get('search-rooms', 'HomeController@searchRooms')->name('search-rooms');



//user routes
// Route::group(['prefix' => 'user', 'middleware'=>['isCustomer']], function() {
	

	Route::get('dashboard', ['uses' => 'UserController@dashboard'])->name('user-dashboard');
	Route::post('book-rooms', ['uses' => 'UserController@bookRooms'])->name('book-rooms');

	Route::get('profile-details', ['uses' => 'UserController@profileDetails'])->name('user-profile');
	Route::post('update-profile-details', ['uses' => 'UserController@updateProfileDetails'])->name('update-profile-details');

	Route::get('change-password', ['uses' => 'UserController@changePassword'])->name('change-password');
	Route::post('update-password', ['uses' => 'UserController@updatePassword'])->name('update-password');
// });

//admin routes
Route::group(['prefix' => 'admin'], function() {
//	Route::get('/get_next_reservation_id', function(){
//        echo getNextInvoiceNo('testing');
//    });
//    Route::get('/apply_booked_rooms', function(){
//    	$settings = getSettings();
//    	$gstPerc = $settings['gst'];
//        $cgstPerc = $settings['cgst'];
//
//    	$booked_room = BookedRoom::query()
//    ->update( [
//						    'room_gst' => DB::raw( '(room_price/100) * '.$gstPerc.'' ),
//						    'room_cgst' => DB::raw( '(room_price/100) * '.$cgstPerc.'' ),
//						]);
// 		// select(
//   //              'id',
//   //              'reservation_id',
//   //              'room_id',
//   //              'room_type_id',
//   //              'room_price',
//   //              'room_gst',
//   //              'room_cgst',
//   //              'check_in',
//   //              'check_out',
//   //              'swapped_from_room',
//   //              'is_checkout',
//   //              'updated_at',
//   //              'created_at',
//   //              DB::raw('(room_price/100) * '.$gstPerc.' AS gst_price'),
//   //              DB::raw('(room_price/100) * '.$cgstPerc.' AS cgst_price')
//   //      )->
//
//
//   //  	get();
//
//       dd($booked_room);
//    });

	Route::get('/', ['uses' => 'LoginController@adminLogin'])->name('login');
	Route::post('do-login', ['uses' => 'LoginController@doLogin'])->name('do-login');
	Route::get('logout', ['uses' => 'LoginController@logout'])->name('logout');
    Route::get('change-setting/{val}', 'ChangeSettingController@changeSetting')->name('change-setting');
    Route::get('view_log_curl', function (){
        $data = \App\CurlRequest::get();
        foreach($data as $d){
            $nd = $d->toArray();
            $nd['post_data'] = (array) json_decode($nd['post_data']);
            $nd['response_data'] = (array) json_decode($nd['response_data']);
            dump($nd);
        }
    });

    Route::get('translate_language', ['uses' => 'LanguageController@translate_language'])->name('translate_language');

    Route::group(['middleware'=>['auth','permission','userlogs']], function() {
        Route::get('dashboard', ['uses' => 'AdminController@index'])->name('dashboard');

        Route::get('profile', ['uses' => 'AdminController@editLoggedUserProfile'])->name('profile');
        Route::post('save-profile', ['uses' => 'AdminController@saveProfile'])->name('save-profile');
        Route::get('add-user', ['uses' => 'AdminController@addUser'])->name('add-user');
        Route::get('edit-user/{id}', ['uses' => 'AdminController@editUser'])->name('edit-user');
        Route::post('save-user', ['uses' => 'AdminController@saveUser'])->name('save-user');
        Route::get('list-user', ['uses' => 'AdminController@listUser'])->name('list-user');
        Route::get('delete-user/{id}', ['uses' => 'AdminController@deleteUser'])->name('delete-user');

        Route::get('add-customer', ['uses' => 'CustomerController@addCustomer'])->name('add-customer');
        Route::get('edit-customer/{id}', ['uses' => 'CustomerController@editCustomer'])->name('edit-customer');
        Route::get('save-customer', ['uses' => 'CustomerController@saveCustomer'])->name('save-customer');
        Route::post('save-customer', ['uses' => 'CustomerController@saveCustomer'])->name('save-customer');
        Route::get('list-customer', ['uses' => 'CustomerController@listCustomer'])->name('list-customer');
        Route::get('delete-customer/{id}', ['uses' => 'CustomerController@deleteCustomer'])->name('delete-customer');

        Route::get('add-company', ['uses' => 'CompanyController@addCompany'])->name('add-company');
        Route::get('edit-company/{id}', ['uses' => 'CompanyController@editCompany'])->name('edit-company');
        Route::post('save-company', ['uses' => 'CompanyController@saveCompany'])->name('save-company');
        Route::get('list-company', ['uses' => 'CompanyController@listCompany'])->name('list-company');
        Route::get('delete-company/{id}', ['uses' => 'CompanyController@deleteCompany'])->name('delete-company');

        Route::get('add-room', ['uses' => 'AdminController@addRoom'])->name('add-room');
        Route::get('edit-room/{id}', ['uses' => 'AdminController@editRoom'])->name('edit-room');
        Route::post('save-room', ['uses' => 'AdminController@saveRoom'])->name('save-room');
        Route::get('list-room', ['uses' => 'AdminController@listRoom'])->name('list-room');
        Route::get('delete-room/{id}', ['uses' => 'AdminController@deleteRoom'])->name('delete-room');

        Route::get('add-room-types', ['uses' => 'AdminController@addRoomType'])->name('add-room-types');
        Route::get('edit-room-types/{id}', ['uses' => 'AdminController@editRoomType'])->name('edit-room-types');
        Route::post('save-room-types', ['uses' => 'AdminController@saveRoomType'])->name('save-room-types');
        Route::get('list-room-types', ['uses' => 'AdminController@listRoomType'])->name('list-room-types');
        Route::get('delete-room-types/{id}', ['uses' => 'AdminController@deleteRoomType'])->name('delete-room-types');

        Route::get('add-amenities', ['uses' => 'AdminController@addAmenities'])->name('add-amenities');
        Route::get('edit-amenities/{id}', ['uses' => 'AdminController@editAmenities'])->name('edit-amenities');
        Route::post('save-amenities', ['uses' => 'AdminController@saveAmenities'])->name('save-amenities');
        Route::get('list-amenities', ['uses' => 'AdminController@listAmenities'])->name('list-amenities');
        Route::get('delete-amenities/{id}', ['uses' => 'AdminController@deleteAmenities'])->name('delete-amenities');

		//		Route::get('quick-check-in', ['uses' => 'AdminController@roomReservation'])->name('quick-check-in');
        Route::get('search-from-customer', ['uses' => 'CustomerController@searchFromCustomer'])->name('search-from-customer');
        Route::get('search-from-company', ['uses' => 'CustomerController@searchFromCompany'])->name('search-from-company');
        Route::get('check-in', ['uses' => 'AdminController@roomReservation'])->name('room-reservation');
        Route::post('save-reservation', ['uses' => 'AdminController@saveReservation'])->name('save-reservation');
        Route::get('check-out/{id}', ['uses' => 'AdminController@checkOut'])->name('check-out-room');
        Route::post('check-out', ['uses' => 'AdminController@saveCheckOutData'])->name('check-out');
        Route::get('list-check-ins', ['uses' => 'AdminController@listReservation'])->name('list-reservation');
        Route::get('list-check-outs', ['uses' => 'AdminController@listCheckOuts'])->name('list-check-outs');
        Route::get('edit-reservation_/{id}', ['uses' => 'AdminController@editReservation'])->name('edit-reservation_');
        Route::get('view-reservation/{id}', ['uses' => 'AdminController@viewReservation'])->name('view-reservation');
        Route::get('cancel-reservation/{id}', ['uses' => 'AdminController@cancelReservation'])->name('cancel-reservation');
        Route::post('cancel-reservation-submit/{id}', ['uses' => 'AdminController@cancelReservationSubmit'])->name('cancel-reservation-submit');
        Route::get('changeto-checkin-reservation/{id}', ['uses' => 'AdminController@changetoCheckinReservation'])->name('changeto-checkin-reservation');
        Route::get('delete-reservation/{id}', ['uses' => 'AdminController@deleteReservation'])->name('delete-reservation');
        Route::get('invoice/{id}/{type}/{inv_type?}', ['uses' => 'AdminController@invoice'])->name('invoice');
        Route::post('advance-pay', ['uses' => 'AdminController@advancePay'])->name('advance-pay');
        Route::post('extend-reservation', ['uses' => 'AdminController@extendDays'])->name('extend-reservation');
        Route::get('swap-room/{id}', ['uses' => 'AdminController@swapRoom'])->name('swap-room')->middleware('PackagePermission:pos');
        Route::post('save-swap-room', ['uses' => 'AdminController@saveSwapRoom'])->name('save-swap-room')->middleware('PackagePermission:pos');
        Route::get('delete-mediafile/{id}', ['uses' => 'AdminController@deleteMediaFile'])->name('delete-mediafile');
        Route::get('mark-as-paid/{id}', ['uses' => 'AdminController@markAsPaid'])->name('mark-as-paid');

        Route::get('add-food-category', ['uses' => 'AdminController@addFoodCategory'])->name('add-food-category')->middleware('PackagePermission:pos');
        Route::get('edit-food-category/{id}', ['uses' => 'AdminController@editFoodCategory'])->name('edit-food-category')->middleware('PackagePermission:pos');
        Route::post('save-food-category', ['uses' => 'AdminController@saveFoodCategory'])->name('save-food-category')->middleware('PackagePermission:pos');
        Route::get('list-food-category', ['uses' => 'AdminController@listFoodCategory'])->name('list-food-category')->middleware('PackagePermission:pos');
        Route::get('delete-food-category/{id}', ['uses' => 'AdminController@deleteFoodCategory'])->name('delete-food-category')->middleware('PackagePermission:pos');

        Route::get('add-food-item', ['uses' => 'AdminController@addFoodItem'])->name('add-food-item')->middleware('PackagePermission:pos');
        Route::get('edit-food-item/{id}', ['uses' => 'AdminController@editFoodItem'])->name('edit-food-item')->middleware('PackagePermission:pos');
        Route::post('save-food-item', ['uses' => 'AdminController@saveFoodItem'])->name('save-food-item')->middleware('PackagePermission:pos');
        Route::get('list-food-item', ['uses' => 'AdminController@listFoodItem'])->name('list-food-item')->middleware('PackagePermission:pos');
        Route::get('delete-food-item/{id}', ['uses' => 'AdminController@deleteFoodItem'])->name('delete-food-item')->middleware('PackagePermission:pos');

        Route::get('add-expense-category', ['uses' => 'AdminController@addExpenseCategory'])->name('add-expense-category')->middleware('PackagePermission:expenses');
        Route::get('edit-expense-category/{id}', ['uses' => 'AdminController@editExpenseCategory'])->name('edit-expense-category')->middleware('PackagePermission:expenses');

        Route::post('save-expense-category', ['uses' => 'AdminController@saveExpenseCategory'])->name('save-expense-category')->middleware('PackagePermission:expenses');

        Route::get('list-expense-category', ['uses' => 'AdminController@listExpenseCategory'])->name('list-expense-category')->middleware('PackagePermission:expenses');
        Route::get('delete-expense-category/{id}', ['uses' => 'AdminController@deleteExpenseCategory'])->name('delete-expense-category')->middleware('PackagePermission:expenses');

        Route::get('add-expense', ['uses' => 'AdminController@addExpense'])->name('add-expense')->middleware('PackagePermission:expenses');
        Route::get('edit-expense/{id}', ['uses' => 'AdminController@editExpense'])->name('edit-expense')->middleware('PackagePermission:expenses');
        Route::post('save-expense', ['uses' => 'AdminController@saveExpense'])->name('save-expense')->middleware('PackagePermission:expenses');
        Route::get('list-expense', ['uses' => 'AdminController@listExpense'])->name('list-expense')->middleware('PackagePermission:expenses');
        Route::get('delete-expense/{id}', ['uses' => 'AdminController@deleteExpense'])->name('delete-expense')->middleware('PackagePermission:expenses');

        Route::get('add-vendor-category', ['uses' => 'VendorController@addCategory'])->name('add-vendor-category');
        Route::get('edit-vendor-category/{id}', ['uses' => 'VendorController@editCategory'])->name('edit-vendor-category');
        Route::post('save-vendor-category', ['uses' => 'VendorController@saveCategory'])->name('save-vendor-category');
        Route::get('list-vendor-category', ['uses' => 'VendorController@listCategory'])->name('list-vendor-category');
        Route::get('delete-vendor-category/{id}', ['uses' => 'VendorController@deleteCategory'])->name('delete-vendor-category');

        Route::get('add-vendor', ['uses' => 'VendorController@add'])->name('add-vendor');
        Route::get('edit-vendor/{id}', ['uses' => 'VendorController@edit'])->name('edit-vendor');
        Route::post('save-vendor', ['uses' => 'VendorController@save'])->name('save-vendor');
        Route::get('list-vendor', ['uses' => 'VendorController@index'])->name('list-vendor');
        Route::get('delete-vendor/{id}', ['uses' => 'VendorController@delete'])->name('delete-vendor');
        Route::get('view-vendor/{id}', ['uses' => 'VendorController@view'])->name('view-vendor');

        Route::get('food-order/{reservation_id?}', ['uses' => 'AdminController@FoodOrder'])->name('food-order')->middleware('PackagePermission:pos');
        Route::get('food-order-table/{order_id}', ['uses' => 'AdminController@FoodOrderTable'])->name('food-order-table')->middleware('PackagePermission:pos');
        Route::get('food-order-final/{order_id}', ['uses' => 'AdminController@FoodOrderFinal'])->name('food-order-final')->middleware('PackagePermission:pos');
        Route::post('save-food-order', ['uses' => 'AdminController@saveFoodOrder'])->name('save-food-order')->middleware('PackagePermission:pos');

        Route::get('orders-list', ['uses' => 'AdminController@listOrders'])->name('orders-list')->middleware('PackagePermission:pos');
        Route::get('order-invoice/{id}', ['uses' => 'AdminController@orderInvoice'])->name('order-invoice')->middleware('PackagePermission:pos');
        Route::get('order-invoice-final/{order_id}', ['uses' => 'AdminController@orderInvoiceFinal'])->name('order-invoice-final')->middleware('PackagePermission:pos');
        Route::get('kitchen-invoice/{order_id}/{order_type}', ['uses' => 'AdminController@kitchenInvoice'])->name('kitchen-invoice')->middleware('PackagePermission:pos');
        Route::get('delete-order-item/{id}', ['uses' => 'AdminController@deleteOrderItem'])->name('delete-order-item')->middleware('PackagePermission:pos');

        Route::get('add-product', ['uses' => 'AdminController@addProduct'])->name('add-product');
        Route::get('edit-product/{id}', ['uses' => 'AdminController@editProduct'])->name('edit-product');
        Route::post('save-product', ['uses' => 'AdminController@saveProduct'])->name('save-product');
        Route::get('list-product', ['uses' => 'AdminController@listProduct'])->name('list-product');
        Route::get('delete-product/{id}', ['uses' => 'AdminController@deleteProduct'])->name('delete-product');

        Route::get('add-housekeeping-item', ['uses' => 'HousekeepingController@addItem'])->name('add-housekeeping-item');
        Route::get('edit-housekeeping-item/{id}', ['uses' => 'HousekeepingController@editItem'])->name('edit-housekeeping-item');
        Route::post('save-housekeeping-item', ['uses' => 'HousekeepingController@saveItem'])->name('save-housekeeping-item');
        Route::get('list-housekeeping-item', ['uses' => 'HousekeepingController@listItem'])->name('list-housekeeping-item');
        Route::get('delete-housekeeping-item/{id}', ['uses' => 'HousekeepingController@deleteItem'])->name('delete-housekeeping-item');
        Route::get('view-housekeeping-item/{id}', ['uses' => 'HousekeepingController@viewItem'])->name('view-housekeeping-item');
        Route::get('update-housekeeping-order-status/{order_id}/{status}', ['uses' => 'HousekeepingController@updateOrderStatus'])->name('update-housekeeping-order-status');

        Route::get('add-housekeeping-order/{room_id?}/{reservation_id?}', ['uses' => 'HousekeepingController@addOrder'])->name('add-housekeeping-order');
        Route::get('edit-housekeeping-order/{id}', ['uses' => 'HousekeepingController@editOrder'])->name('edit-housekeeping-order');
        Route::post('save-housekeeping-order', ['uses' => 'HousekeepingController@saveOrder'])->name('save-housekeeping-order');
        Route::get('list-housekeeping-order', ['uses' => 'HousekeepingController@index'])->name('list-housekeeping-order');
        Route::get('delete-housekeeping-order/{id}', ['uses' => 'HousekeepingController@deleteOrder'])->name('delete-housekeeping-order');
        Route::get('view-housekeeping-order/{id}', ['uses' => 'HousekeepingController@viewOrder'])->name('view-housekeeping-order');

        Route::get('add-laundry-item', ['uses' => 'LaundryController@addItem'])->name('add-laundry-item')->middleware('PackagePermission:laundry');
        Route::get('edit-laundry-item/{id}', ['uses' => 'LaundryController@editItem'])->name('edit-laundry-item')->middleware('PackagePermission:laundry');
        Route::post('save-laundry-item', ['uses' => 'LaundryController@saveItem'])->name('save-laundry-item')->middleware('PackagePermission:laundry');
        Route::get('list-laundry-item', ['uses' => 'LaundryController@listItem'])->name('list-laundry-item')->middleware('PackagePermission:laundry');
        Route::get('delete-laundry-item/{id}', ['uses' => 'LaundryController@deleteItem'])->name('delete-laundry-item')->middleware('PackagePermission:laundry');
        Route::get('view-laundry-item/{id}', ['uses' => 'LaundryController@viewItem'])->name('view-laundry-item')->middleware('PackagePermission:laundry');
        Route::get('update-laundry-order-status/{order_id}/{status}', ['uses' => 'LaundryController@updateOrderStatus'])->name('update-laundry-order-status')->middleware('PackagePermission:laundry');

        Route::get('add-laundry-order', ['uses' => 'LaundryController@addOrder'])->name('add-laundry-order')->middleware('PackagePermission:pos');
        Route::get('edit-laundry-order/{id}', ['uses' => 'LaundryController@editOrder'])->name('edit-laundry-order')->middleware('PackagePermission:pos');
        Route::post('save-laundry-order', ['uses' => 'LaundryController@saveOrder'])->name('save-laundry-order')->middleware('PackagePermission:pos');
        Route::get('list-laundry-order', ['uses' => 'LaundryController@index'])->name('list-laundry-order')->middleware('PackagePermission:laundry');
        Route::get('delete-laundry-order/{id}', ['uses' => 'LaundryController@deleteOrder'])->name('delete-laundry-order')->middleware('PackagePermission:laundry');
        Route::get('view-laundry-order/{id}', ['uses' => 'LaundryController@viewOrder'])->name('view-laundry-order')->middleware('PackagePermission:laundry');
        Route::get('invoice-laundry-order/{id}', ['uses' => 'LaundryController@invoice'])->name('invoice-laundry-order')->middleware('PackagePermission:laundry');

        Route::get('add-season', ['uses' => 'SeasonController@add'])->name('add-season');
        Route::get('edit-season/{id}', ['uses' => 'SeasonController@edit'])->name('edit-season');
        Route::post('save-season', ['uses' => 'SeasonController@save'])->name('save-season');
        Route::get('list-season', ['uses' => 'SeasonController@index'])->name('list-season');
        Route::get('delete-season/{id}', ['uses' => 'SeasonController@delete'])->name('delete-season');

        Route::get('io-stock', ['uses' => 'AdminController@inOutStock'])->name('io-stock');
        Route::post('save-stock', ['uses' => 'AdminController@saveStock'])->name('save-stock');
        Route::get('stock-history', ['uses' => 'AdminController@stockHistory'])->name('stock-history');
        Route::get('delete-stock-history/{id}', ['uses' => 'AdminController@deleteStockHistory'])->name('delete-stock-history');

        Route::get('settings', 'AdminController@settingsForm')->name('settings');
        Route::post('/save-settings', 'AdminController@saveSettings')->name('save-settings');

        Route::get('sms-settings', 'AdminController@settingsSms')->name('sms-settings');
        // Route::post('/save-settings', 'AdminController@saveSettings')->name('save-settings');

        Route::get('permissions-list', 'AdminController@listPermission')->name('permissions-list');
        Route::post('/save-permissions', 'AdminController@savePermission')->name('save-permissions');
        Route::post('/save-business-permissions', 'AdminController@saveBusinessPermission')->name('save-business-permissions');

        Route::get('dynamic-dropdown-list', 'AdminController@listDynamicDropdowns')->name('dynamic-dropdown-list');
        Route::post('/save-dynamic-dropdowns', 'AdminController@saveDynamicDropdowns')->name('save-dynamic-dropdowns');

        Route::get('language-translations', 'LanguageController@index')->name('language-translations');
        Route::post('/save-language-translations', 'LanguageController@saveTranslations')->name('save-language-translations');

        Route::get('/reports', 'ReportController@index')->name('reports');

        Route::post('/search-orders', 'ReportController@searchOrders')->name('search-orders');
        Route::post('/export-orders', 'ReportController@exportOrders')->name('export-orders');

        Route::post('/search-stocks', 'ReportController@searchStockHistory')->name('search-stocks');
        Route::post('/export-stocks', 'ReportController@exportStockHistory')->name('export-stocks');

        Route::post('/search-checkins', 'ReportController@searchCheckins')->name('search-checkins');
        Route::post('/export-checkins', 'ReportController@searchCheckins')->name('export-checkins');

        Route::any('/search-checkouts', 'ReportController@searchCheckouts')->name('search-checkouts');
        Route::post('/export-checkouts', 'ReportController@searchCheckouts')->name('export-checkouts');

        Route::any('/search-bladi', 'ReportController@searchBladi')->name('search-bladi');
        Route::post('/export-bladi', 'ReportController@searchBladi')->name('export-bladi');
        Route::post('/search-expenses', 'ReportController@searchExpense')->name('search-expenses')->middleware('PackagePermission:expenses');
        Route::post('/export-expenses', 'ReportController@searchExpense')->name('export-expenses')->middleware('PackagePermission:expenses');

        Route::post('/search-customer', 'ReportController@searchCustomer')->name('search-customer');
        Route::get('/search-customer', 'ReportController@searchCustomer')->name('search-customer');
        Route::post('/export-customer', 'ReportController@searchCustomer')->name('export-customer');

        Route::post('/search-company', 'ReportController@searchCompany')->name('search-company');
        Route::post('/export-company', 'ReportController@searchCompany')->name('export-company');

        Route::get('/search-payment-history', 'ReportController@searchPaymentHistory')->name('search-payment-history');
        Route::post('/search-payment-history', 'ReportController@searchPaymentHistory')->name('search-payment-history');
        Route::post('/export-payment-history', 'ReportController@searchPaymentHistory')->name('export-payment-history');

        Route::post('/search-laundry-order', 'ReportController@searchLaundryOrder')->name('search-laundry-order')->middleware('PackagePermission:laundry');
        Route::get('/search-laundry-order', 'ReportController@searchLaundryOrder')->name('search-laundry-order')->middleware('PackagePermission:laundry');
        Route::post('/export-laundry-order', 'ReportController@exportLaundryOrder')->name('export-laundry-order')->middleware('PackagePermission:laundry');

        //website pages
        Route::get('home-page', 'WebsitePagesController@homePage')->name('home-page')->middleware('PackagePermission:website');
        Route::post('update-home-page', 'WebsitePagesController@updateHomePage')->name('update-home-page')->middleware('PackagePermission:website');

        Route::get('contact-page', 'WebsitePagesController@contactPage')->name('contact-page')->middleware('PackagePermission:website');
        Route::post('update-contact-data', 'WebsitePagesController@updateContactPage')->name('update-contact-page')->middleware('PackagePermission:website');

        Route::get('about-page', 'WebsitePagesController@aboutPage')->name('about-page')->middleware('PackagePermission:website');
        Route::post('update-about-data', 'WebsitePagesController@updateAboutPage')->name('update-about-page')->middleware('PackagePermission:website');
        /// Super Admin
		Route::post('save-business','SuperAdminController@saveBusiness')->name('save-business');
		Route::get('add-business','SuperAdminController@addBusiness')->name('add-business');
		Route::get('edit-business/{id}', ['uses' => 'SuperAdminController@editBusinessData'])->name('edit-business');
		Route::match(['post', 'put'], 'update-business/{id}', 'SuperAdminController@updateBusinessData')->name('update-business');
		Route::get('all-business','SuperAdminController@allBusiness')->name('all-business');
		Route::get('delete-business/{id}','SuperAdminController@deleteBusinessData')->name('delete-business');

		Route::get('all-business-data','SuperAdminController@allBusinessData')->name('all-business-data');
		//package routes
		Route::get('add-package','SuperAdminController@addPackage')->name('add-package');
		Route::get('all-packages','SuperAdminController@allPackages')->name('all-packages');
		Route::post('save-package','SuperAdminController@savePackage')->name('save-package');
		Route::get('all-package-data','SuperAdminController@allPackageData')->name('all-package-data');
		Route::get('delete-package/{id}','SuperAdminController@deletePackageData')->name('delete-package');
		Route::get('edit-package/{id}', ['uses' => 'SuperAdminController@editPackageData'])->name('edit-package');
    });
});

//cron routes
Route::get('check-product-expiry', 'CronController@checkProductExpiry')->name('check-product-expiry');

//public routes
Route::get('langtrans', 'PublicController@updateLangTransFromLocalFile')->name('langtrans');

Route::get('access-denied',function() {
		return view('page_403');
})->name('access-denied');

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Re-optimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Re-optimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//DB migrate
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return '<h1>Data tables import success</h1>';
});

//clear cache and view
Route::get('/clear', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    return '<div style="width: 100%;
    border: 2px dotted #3dcd96;
    background: #eee;
    color: #68696d;
    text-align: center;
    border-radius: 4px;"><h1>Config & View cache cleared successfully.</h1></div>';
});

