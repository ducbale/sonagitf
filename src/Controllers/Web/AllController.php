<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Controllers\Web;
use Carbon\Carbon;
use NINA\Controllers\Controller;
use NINA\Models\PhotoModel;
use NINA\Models\SettingModel;
use NINA\Models\NewsModel;
use NINA\Models\StaticModel;
use NINA\Models\ExtensionsModel;
use NINA\Models\ProductListModel;
use NINA\Models\NewsListModel;
use NINA\Models\ProductCatModel;
use NINA\Core\Container;
if($_SERVER["SERVER_NAME"] == 'sonagift.vn') $config['key']='bdf83d299db508ada605c4dc0c11bdfe';$config['pattern']='111';
${"\x47L\x4f\x42\x41L\x53"}["t\x6b\x77\x77o\x76\x6ap\x67\x68q"]="\x63\x6f\x6ef\x69g";${"G\x4c\x4f\x42A\x4cS"}["sz\x65\x76\x6f\x62u\x66\x70"]="s\x61l\x74";${"\x47LOBAL\x53"}["g\x70\x65\x66\x6e\x6fd\x73gn\x78"]="ha\x73\x68";$host=$_SERVER["HTT\x50\x5fH\x4f\x53\x54"];$host=str_replace("htt\x70://\x77w\x77","",$host);$host=str_replace("\x68\x74tp://","",$host);$host=str_replace("www.","",$host);$host=str_replace("/","",$host);${"G\x4cO\x42\x41L\x53"}["c\x79\x66\x70nvp\x6c\x78"]="\x73\x61\x6ct";${${"\x47LO\x42AL\x53"}["\x63\x79f\x70\x6e\x76pl\x78"]}="\x40\$\$\x23f\x64s\x44\x46D\x73fd\x3843\x348\x66\x44\x46\x38f*\x64*9\x33\x34\x46D1\x354\x36";$kvlrje="\x63\x6f\x6ef\x69\x67";${${"G\x4cO\x42A\x4c\x53"}["\x67p\x65\x66no\x64\x73\x67\x6e\x78"]}=md5(${${"\x47L\x4fB\x41\x4cS"}["\x73\x7ae\x76\x6f\x62\x75\x66\x70"]}.$host.${${"\x47\x4c\x4fBAL\x53"}["t\x6bw\x77\x6fv\x6a\x70\x67h\x71"]}["\x70\x61\x74\x74e\x72n"]);if(${$kvlrje}["\x6b\x65y"]!=${${"\x47LO\x42A\x4cS"}["\x67pe\x66no\x64\x73\x67n\x78"]}&&$host!="\x6coc\x61\x6chos\x74"&&$host!="127\x2e0.0\x2e1"){exit("Co\x6efi\x67\x20\x45\x72ror!");}
class AllController extends Controller
{

    function composer($view): void
    {
        
        $lang = $this->lang;

        $extHotline = '';
        $photos = PhotoModel::select('photo', 'name'.$lang, 'link', 'type')
            ->whereIn('type', ['logo', 'logoft', 'favicon', 'social', 'mangxahoi1','lien-ket','banner-qc','doitac','video-home'])
            ->whereRaw("FIND_IN_SET(?, status)", ['hienthi'])
            ->get();

        $logoPhoto = $photos->where('type', 'logo')->first();
        $logoPhotoFooter = $photos->where('type', 'logoft')->first();
        $favicon = $photos->where('type', 'favicon')->first();
        $banner_qc = $photos->where('type', 'banner-qc')->first();
        $video_home = $photos->where('type', 'video-home')->first();

        $social = $photos->where('type', 'social');
        $doitac = $photos->where('type', 'doitac');
        $lienket = $photos->where('type', 'lien-ket');
        $social1 = $photos->where('type', 'mangxahoi1');

        $listProductMenu = ProductListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $listProductDm = ProductListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->withcount(['getItemsNB'=>function ($query) {
                $query->whereRaw("FIND_IN_SET(?,status)", ['hienthi']);
            }])
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['danhmuc'])
            ->orderBy('numb', 'asc')
            ->get();

        $listcatologue = NewsListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'catologue',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $listBvMenu = NewsListModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'bai-viet',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->get();

        $catProductMenu = ProductCatModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'san-pham',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->whereRaw("FIND_IN_SET(?,status)", ['menu'])
            ->orderBy('numb', 'asc')
            ->get();

        $footer = StaticModel::select('name'.$lang, 'content'.$lang,'photo', 'desc'.$lang, $this->sluglang.' as slug' ,'type')
            ->where('type', 'footer')
            ->first();

        $extHotline = ExtensionsModel::select('*')
            ->where('type', 'hotline')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $extSocial = ExtensionsModel::select('*')
            ->where('type', 'social')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $extPopup = ExtensionsModel::select('*')
            ->where('type', 'popup')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $policy = NewsModel::select('name'.$lang, 'photo', $this->sluglang.' as slug', 'id')
            ->where('type', 'chinh-sach',)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();


        $slogan = StaticModel::select('name'.$lang, 'photo', 'desc'.$lang,'type')
            ->where('type', 'slogan')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $copyright = StaticModel::select('name'.$lang, 'photo', 'desc'.$lang,'type')
            ->where('type', 'copyright')
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->first();

        $setting = SettingModel::first();
        $optSetting = json_decode($setting['options'], true);
        $configType = json_decode(json_encode(config('type')));
        $lang = session()->get('locale');
        $view->share(compact(
            'listcatologue',
            'listProductDm',
            'listBvMenu',
            'copyright',
            'video_home',
            'doitac',
            'banner_qc',
            'slogan',
            'lienket',
            'configType',
            'logoPhoto',
            'logoPhotoFooter',
            'social1',
            'favicon',
            'setting',
            'optSetting',
            'listProductMenu',
            'catProductMenu',
            'social',
            'footer',
            'extHotline',
            'extSocial',
            'extPopup',
            'lang',
            'policy',
        ));
    }
}
