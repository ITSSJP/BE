<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionaryWordsSeeder extends Seeder
{
    public function run()
    {
        $words = [
            ['ja' => '学校', 'furigana' => 'がっこう', 'vie' => 'Trường học'],
            ['ja' => '先生', 'furigana' => 'せんせい', 'vie' => 'Giáo viên'],
            ['ja' => '友達', 'furigana' => 'ともだち', 'vie' => 'Bạn bè'],
            ['ja' => '猫', 'furigana' => 'ねこ', 'vie' => 'Con mèo'],
            ['ja' => '犬', 'furigana' => 'いぬ', 'vie' => 'Con chó'],
            ['ja' => '本', 'furigana' => 'ほん', 'vie' => 'Sách'],
            ['ja' => '水', 'furigana' => 'みず', 'vie' => 'Nước'],
            ['ja' => '火', 'furigana' => 'ひ', 'vie' => 'Lửa'],
            ['ja' => '風', 'furigana' => 'かぜ', 'vie' => 'Gió'],
            ['ja' => '空', 'furigana' => 'そら', 'vie' => 'Bầu trời'],
            ['ja' => '山', 'furigana' => 'やま', 'vie' => 'Núi'],
            ['ja' => '川', 'furigana' => 'かわ', 'vie' => 'Sông'],
            ['ja' => '家', 'furigana' => 'いえ', 'vie' => 'Nhà'],
            ['ja' => '車', 'furigana' => 'くるま', 'vie' => 'Xe ô tô'],
            ['ja' => '電車', 'furigana' => 'でんしゃ', 'vie' => 'Tàu điện'],
            ['ja' => '駅', 'furigana' => 'えき', 'vie' => 'Nhà ga'],
            ['ja' => '雨', 'furigana' => 'あめ', 'vie' => 'Mưa'],
            ['ja' => '雪', 'furigana' => 'ゆき', 'vie' => 'Tuyết'],
            ['ja' => '花', 'furigana' => 'はな', 'vie' => 'Hoa'],
            ['ja' => '木', 'furigana' => 'き', 'vie' => 'Cây'],
            ['ja' => '魚', 'furigana' => 'さかな', 'vie' => 'Cá'],
            ['ja' => '鳥', 'furigana' => 'とり', 'vie' => 'Chim'],
            ['ja' => '人', 'furigana' => 'ひと', 'vie' => 'Người'],
            ['ja' => '子供', 'furigana' => 'こども', 'vie' => 'Trẻ em'],
            ['ja' => '大人', 'furigana' => 'おとな', 'vie' => 'Người lớn'],
            ['ja' => '道', 'furigana' => 'みち', 'vie' => 'Con đường'],
            ['ja' => '光', 'furigana' => 'ひかり', 'vie' => 'Ánh sáng'],
            ['ja' => '月', 'furigana' => 'つき', 'vie' => 'Mặt trăng'],
            ['ja' => '太陽', 'furigana' => 'たいよう', 'vie' => 'Mặt trời'],
            ['ja' => '星', 'furigana' => 'ほし', 'vie' => 'Ngôi sao'],
            ['ja' => '時間', 'furigana' => 'じかん', 'vie' => 'Thời gian'],
            ['ja' => '手', 'furigana' => 'て', 'vie' => 'Tay'],
            ['ja' => '足', 'furigana' => 'あし', 'vie' => 'Chân'],
            ['ja' => '耳', 'furigana' => 'みみ', 'vie' => 'Tai'],
            ['ja' => '目', 'furigana' => 'め', 'vie' => 'Mắt'],
            ['ja' => '口', 'furigana' => 'くち', 'vie' => 'Miệng'],
            ['ja' => '心', 'furigana' => 'こころ', 'vie' => 'Trái tim'],
            ['ja' => '愛', 'furigana' => 'あい', 'vie' => 'Tình yêu'],
            ['ja' => '夢', 'furigana' => 'ゆめ', 'vie' => 'Giấc mơ'],
            ['ja' => '希望', 'furigana' => 'きぼう', 'vie' => 'Hy vọng'],
            ['ja' => '夜', 'furigana' => 'よる', 'vie' => 'Ban đêm'],
            ['ja' => '朝', 'furigana' => 'あさ', 'vie' => 'Buổi sáng'],
            ['ja' => '昼', 'furigana' => 'ひる', 'vie' => 'Buổi trưa'],
            ['ja' => '夕方', 'furigana' => 'ゆうがた', 'vie' => 'Chiều tối'],
            ['ja' => '仕事', 'furigana' => 'しごと', 'vie' => 'Công việc'],
            ['ja' => '休み', 'furigana' => 'やすみ', 'vie' => 'Nghỉ ngơi'],
            ['ja' => '勉強', 'furigana' => 'べんきょう', 'vie' => 'Học tập'],
            ['ja' => '音楽', 'furigana' => 'おんがく', 'vie' => 'Âm nhạc'],
            ['ja' => '映画', 'furigana' => 'えいが', 'vie' => 'Phim ảnh'],
            ['ja' => '旅行', 'furigana' => 'りょこう', 'vie' => 'Du lịch'],
            ['ja' => '写真', 'furigana' => 'しゃしん', 'vie' => 'Ảnh chụp'],
            ['ja' => '食べ物', 'furigana' => 'たべもの', 'vie' => 'Đồ ăn'],
            ['ja' => '飲み物', 'furigana' => 'のみもの', 'vie' => 'Đồ uống'],
            ['ja' => '健康', 'furigana' => 'けんこう', 'vie' => 'Sức khỏe'],
            ['ja' => '運動', 'furigana' => 'うんどう', 'vie' => 'Vận động'],
            ['ja' => '家族', 'furigana' => 'かぞく', 'vie' => 'Gia đình'],
            ['ja' => '友人', 'furigana' => 'ゆうじん', 'vie' => 'Người bạn'],
        ];

        DB::table('dictionary_words')->insert($words);
    }
}
