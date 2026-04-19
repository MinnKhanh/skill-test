<?php

return [

    /*
    |--------------------------------------------------------------------------
    | バリデーションの言語行
    |--------------------------------------------------------------------------
    |
    | 次の言語行には、バリデータクラスで使用されるデフォルトの
    | エラーメッセージが含まれています。これらのルールの一部には、
    | サイズルールなどの複数のバージョンがあります。
    | ここでこれらの各メッセージを自由に調整してください。
    |
    */

    'accepted' => ':attributeを承認してください。',
    'active_url' => ':attributeには有効なURLを指定してください。',
    'after' => ':attributeには:date以降の日付を指定してください。',
    'after_or_equal' => ':attributeには:dateかそれ以降の日付を指定してください。',
    'alpha' => ':attributeには英字のみからなる文字列を指定してください。',
    'alpha_dash' => ':attributeには英数字・ハイフン・アンダースコアのみからなる文字列を指定してください。',
    'alpha_num' => ':attributeには英数字のみからなる文字列を指定してください。',
    'array' => ':attributeには配列を指定してください。',
    'before' => ':attributeには:date以前の日付を指定してください。',
    'before_or_equal' => ':attributeには:dateかそれ以前の日付を指定してください。',
    'between' => [
        'numeric' => ':attributeは:min～:maxの数字を入力してください。',
        'file' => ':attributeには:min～:max KBのファイルを指定してください。',
        'string' => ':attributeには:min～:max文字の文字列を指定してください。',
        'array' => ':attributeには:min～:max個の要素を持つ配列を指定してください。',
    ],
    'boolean' => ':attributeには真偽値を指定してください。',
    'confirmed' => ':attributeが確認用の値と一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_equals' => ':attributeは:dateと同じ日付でなければなりません。',
    'date_format' => ':attributeは:format形式と一致しません。',
    'different' => ':attributeには:otherとは異なる値を指定してください。',
    'digits' => ':attributeは:digits桁の数字でなければなりません。',
    'digits_between' => ':attributeは:min～:max桁の数字である必要があります。',
    'dimensions' => ':attributeの画像サイズが無効です。',
    'distinct' => ':attributeに指定された値は重複しています。',
    'email' => ':attributeは有効なメールアドレスでなければなりません。',
    'ends_with' => ':attributeは、:valuesのいずれかで終了する必要があります。',
    'exists' => '選択された:attributeは無効です。',
    'file' => ':attributeはファイルでなければなりません。',
    'filled' => ':attributeには値が必要です。',
    'invalid_postcode' => '郵便の形式が正しくありません。',
    'gt' => [
        'numeric' => ':attributeは:valueより大きくなければなりません。',
        'file' => ':attributeは:valueキロバイトより大きくなければなりません。',
        'string' => ':attributeは:value文字より大きくなければなりません。',
        'array' => ':attributeには:valueより多くのアイテムが必要です。',
    ],
    'gte' => [
        'numeric' => ':attributeは:value以上でなければなりません。',
        'file' => ':attributeは:valueキロバイト以上でなければなりません。',
        'string' => ':attributeは:value文字以上でなければなりません。',
        'array' => ':attributeには:value以上のアイテムが必要です。',
    ],
    'image' => ':attributeは画像でなければなりません。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeは:otherに存在しません。',
    'integer' => ':attributeは整数でなければなりません。',
    'ip' => ':attributeは有効なIPアドレスでなければなりません。',
    'ipv4' => ':attributeは有効なIPv4アドレスでなければなりません。',
    'ipv6' => ':attributeは有効なIPv6アドレスでなければなりません。',
    'json' => ':attributeは有効なJSON文字列でなければなりません。',
    'lt' => [
        'numeric' => ':attributeは:valueより小さくなければなりません。',
        'file' => ':attributeは:valueキロバイトより小さくなければなりません。',
        'string' => ':attributeは:value文字より小さくなければなりません。',
        'array' => ':attributeには:valueより少ないアイテムが必要です。',
    ],
    'lte' => [
        'numeric' => ':attributeは:value以下でなければなりません。',
        'file' => ':attributeは:valueキロバイト以下でなければなりません。',
        'string' => ':attributeは:value文字以下でなければなりません。',
        'array' => ':attributeには:value以下のアイテムが必要です。',
    ],
    'max' => [
        'numeric' => ':attributeは:maxより大きくてはいけません。',
        'file' => ':attributeは:maxキロバイトを超えてはいけません。',
        'string' => ':attributeは:max文字以内で入力してください。',
        'array' => ':attributeには:max個を超えるアイテムを含めることはできません。',
    ],
    'mimes' => ':attributeは:valuesタイプのファイルでなければなりません。',
    'mimetypes' => ':attributeは:valuesタイプのファイルでなければなりません。',
    'min' => [
        'numeric' => ':attributeは:minより小さくてはいけません。',
        'file' => ':attributeは:minキロバイトより小さくてはいけません。',
        'string' => ':attributeは:min文字より小さくてはいけません。',
        'array' => ':attributeには少なくとも:min個のアイテムが必要です。',
    ],
    'multiple_of' => ':attributeは:valueの倍数である必要があります。',
    'not_in' => '選択された:attributeは無効です。',
    'not_regex' => ':attributeは無効な形式です。',
    'numeric' => ':attributeは数値でなければなりません。',
    'password' => 'パスワードが間違っています。',
    'present' => ':attributeが存在する必要があります。',
    'regex' => ':attributeは無効な形式です。',
    'required' => ':attributeが入力されていません。',
    'required_if' => ':otherが:valueの場合、:attributeは必須です。',
    'required_unless' => ':otherが:valueではない場合、:attributeは必須です。',
    'required_with_date' => ':attributeが入力されていません。',
    'required_with' => ':valuesのうち一つでも存在する場合、:attributeは必須です。',
    'required_with_all' => ':valuesのうち全て存在する場合、:attributeは必須です。',
    'required_without' => ':valuesのうちどれか一つでも存在していない場合、:attributeは必須です。',
    'required_without_all' => ':valuesのうち全て存在していない場合、:attributeは必須です。',
    'prohibited' => ':attributeは禁止されています。',
    'prohibited_if' => ':otherが:valueの場合、:attributeは禁止されています。',
    'prohibited_unless' => ':otherが:valuesにない限り、:attributeは禁止されています。',
    'same' => ':attributeと:otherは一致する必要があります。',
    'size' => [
        'numeric' => ':attributeは:sizeでなければなりません。',
        'file' => ':attributeは:sizeキロバイトでなければなりません。',
        'string' => ':attributeは:size文字でなければなりません。',
        'array' => ':attributeには:sizeが含まれている必要があります。',
    ],
    'starts_with' => ':attributeは:valuesのいずれかで始まる必要があります。',
    'string' => ':attributeは文字列でなければなりません。',
    'timezone' => ':attributeは有効なタイムゾーンでなければなりません。',
    'unique' => ':attributeはすでに使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeは有効なURLを入力してください。',
    'uuid' => ':attributeは有効なUUIDでなければなりません。',
    'name_katana' => ':attributeは全角カナの255文字以内で入力してください。',

    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーションの言語行
    |--------------------------------------------------------------------------
    |
    | ここでは、「attribute.rule」という規則を使用して行に名前を付けて、
    | 属性のカスタム検証メッセージを指定できます。 これにより、特定の属性ルールに
    | 特定のカスタム言語行をすばやく指定できます。
    |
    */

    'password_regex' => 'パスワードは、6～20 文字、文字、数字、および特殊文字で構成されます。',
    'upload_error_type' => 'アップロードの種類が無効です。',
    'food_option_items' => '必須オプション項目は 1 つだけ選択できます',
    'food_option_items_name' => 'ラベルはすでに存在します。',
    'without_space' => ':attributeにはスペースは含まれません。',
    'user_first_name' => 'セイは全角カタカナで入力してください。',
    'user_last_name' => 'メイは全角カタカナで入力してください。',
    'phone_not_verified' => '電話番号認証にエラーが発生しました。',
    'user_first_name_admin' => '姓（フリガナ）は全角カタカナで入力してください。',
    'user_last_name_admin' => '名（フリガナ）は全角カタカナで入力してください。',
    'domain_unique' => 'このドメイン名は既に使用されています。',
    'domain_invalid' => '無効なドメイン名です。',

    'custom' => [
        'birthday' => [
            'before' => '今日以前の日付を入力してください。',
        ],
        'zip_code' => [
            'digits_between' => '郵便番号は半角数字:max桁を入力してください。',
        ],
        'phone_number' => [
            'digits_between' => '電話番号は:min桁または:max桁の半角数字で入力してください。',
        ],
        'business_type_id' => [
            'required' => ':attributeを選択してください。',
        ],
        'username' => [
            'regex' => 'ユーザーIDは4文字以上40文字以内で入力してください。',
            'between' => [
                'string' => ':attributeは:min文字以上:max文字以内で入力してください。',
            ],
            'alpha_dash' => 'ユーザーIDは4文字以上40文字以内で入力してください。',
        ],
        'image' => [
            'max' => [
                'file' => 'ファイルのアップロードに失敗しました。',
            ],
            'mimes' => 'ファイルのアップロードに失敗しました。',
            'mimetypes' => 'ファイルのアップロードに失敗しました。',
        ],
        'available_to' => [
            'after' => '終了日時が開始日時より後の日付を入力してください。',
        ],
        'available_from' => [
            'after_or_equal' => '開始日時は現在時刻以降を入力してください。',
        ],
        'age_from' => [
            'between' => ':attributeは:min～:maxの数値を入力してください。',
            'integer' => ':attributeは数値で入力してください。',
        ],
        'age_to' => [
            'between' => ':attributeは:min～:maxの数値を入力してください。',
            'integer' => ':attributeは数値で入力してください。',
            'gte' => '有効な値を入力してください。',
        ],
        'discount_rate' => [
            'between' => ':attributeは:min～:maxの数字を入力してください。',
            'integer' => ':attributeは数値で入力してください。',
        ],
        'password' => [
            'required' => 'パスワードは半角英数6〜20文字以上にする必要があります。',
        ],
        'start_at' => [
            'after_or_equal' => '開始日時は現在時刻以降を入力してください。',
        ],
        'event_date' => [
            'after_or_equal' => '開催日には今日かそれ以降の日付を指定してください。',
        ],
        'expired_at' => [
            'after_or_equal' => '開催日には今日かそれ以降の日付を指定してください。',
        ],
        'questions.*.answer' => [
            'required_if' => 'が単一回答の場合、回答は必須です。',
        ],
        'stripe_card_id' => [
            'required_if' => '決済方法がクレジットカードの場合、バンクカードは必須です。',
        ],
    ],

    'my_validate' => [
        'user' => [
            'note' => [
                'required' => '非アクティブされた理由が入力されていません。',
            ],
            'birthday' => [
                'required' => '生年月日を選択してください。',
                'before' => '生年月日には今日以前の日付を指定してください。',
            ],
        ],
        'order' => [
            'coupon_id' => [
                'not_found' => '何かのエラーが発生しました。後ほどもう一度実行してください。',
                'limit' => '先着利用上限回数に達しました。',
                'min_purchase' => '注文が最低支払限度額に達していません。',
                'cannot_apply_now' => 'クーポンは現在適用できません。',
                'expired_time' => 'クーポンは期限切れです。',
                'invalid' => '何かのエラーが発生しました。後ほどもう一度実行してください。',
            ],
        ],
        'event' => [
            'start_at' => [
                'date_format' => '開始時間はY/m/d H:i:s形式と一致しません。',
            ],
            'end_at' => [
                'date_format' => '終了時間はY/m/d H:i:s形式と一致しません。',
            ],
        ],
        'lesson' => [
            'required_options' => '質問文を入力してください',
            'required_correct_answer' => '質問文を入力してください',
            'result_user_answer' => [
                'required_if_type_1' => 'が選択回答の場合、回答は必須です。',
                'required_if_type_2' => 'がファイルアップロードの場合、回答は必須です。',
                'required_if_type_3' => '記述式の場合、回答は必須です。',
                'max' => '記述式は1000文字以内で入力してください。',
                'url' => '回答は有効なURLを入力してください。',
                'array' => '回答には配列を指定してください。',
                'existed' => '回答に重複する値を含めることはできません。',
            ],
        ],
        'email' => 'メールアドレスが正しく入力されていません。',
        'phone' => '電話番号が正しく入力されていません。',
        'email_existed' => 'メールアドレスは既に存在します。',
    ],

    'my_attributes' => [
        'workspace' => 'ワークスペース',
        'lesson' => 'コンテンツ',
        'course' => 'コース',
        'content' => '本文',
        'trial_link' => '招待リンク',
        'operator' => [
            'operator' => 'アカウント',
            'name' => 'アカウント名',
            'email' => 'メールアドレス',
            'role' => '権限',
            'password' => 'パスワード',
            'department' => '所属',
            'status' => 'ステータス',
            'token' => 'トークン',
        ],
        'password' => [
            'current_password' => '元のパスワード',
            'password' => '新しいパスワード',
            'password_confirmation' => '新しいパスワード（確認用）',
        ],
        'company' => [
            'name' => '会社名',
            'website' => 'URL',
            'industry' => '業界',
            'recruitment_type' => '採用種別',
            'postcode' => '郵便番号',
            'prefecture' => '都道府県',
            'city' => '市区町村',
            'address' => '町名番地 ＋ 建物名室番',
            'jobs' => '職種',
            'tags' => 'タグ',
        ],
        'training' => [
            'lesson_no' => 'NO',
            'title' => 'タイトル',
            'image' => '写真',
            'status' => 'ステータス',
            'file' => 'ファイル',
            'tag' => 'タグ',
            'author' => '著者',
            'category' => 'カテゴリー',
            'sub_category' => '子カテゴリー',
            'plan' => '受講可能プラン',
            'related_lesson' => '続けて受講するコンテンツ',
        ],
        'upload' => [
            'image_type' => '画像タイプ',
        ],
        'event' => [
            'title' => 'ワークショップ名',
            'start_at' => '開始時間',
            'end_at' => '終了時間',
            'type' => '参加形態',
            'teacher_name' => '講師',
            'teacher_email' => '講師のメールアドレス',
            'event_date' => '開催日',
            'content' => '本文',
        ],
        'store_name' => 'STORY.No',
        'episode_name' => 'EPISODE.No',
        'plan' => [
            'plan' => 'プラン',
            'name' => 'プラン名',
            'payment_type' => '支払い方法',
            'payment_total_amount' => '合計金額',
            'payment_expiry_times' => '使用期限',
            'payment_expiry_times_unit' => '時間単位',
            'payment_times' => '支払い回数',
            'subscription_type' => '請求サイクル',
            'subscription_initial_amount' => '初期費用',
            'subscription_amount' => '支払い金額',
            'status' => 'ステータス',
            'expired_at' => 'プランの有効期限',
        ],
        'payment' => [
            'plan_id' => 'プラン名',
            'payment_method' => '決済方法',
            'stripe_card_id' => 'バンクカード',
        ],
        'setting' => [
            'name' => 'サイト名',
            'email_org_name' => 'メール用サイトタイトル（変数：{%email_org_name%｝）',
            'contact_email' => 'メールでの問い合わせ先（変数：{%contact_email%｝）',
            'logo_white_url' => '明るいロゴ',
            'logo_dark_url' => 'ダークロゴ',
            'favicon_url' => 'ファビコン',
            'learning_style' => '受講スタイル',
        ],
        'workspace_label' => [
            'value' => 'ラベル',
            'value_en' => 'ラベル（英語)',
        ],
        'workspace_nav' => [
            'link' => 'URL',
            'name' => 'ラベル',
            'name_en' => 'ラベル（英語）',
        ],
        'user' => [
            'note' => '本文',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション属性
    |--------------------------------------------------------------------------
    |
    | 次の言語行を使用して、属性プレースホルダーを「email」ではなく「E-Mail Address」などの
    | 読みやすいものに置き換えます。 これは単にメッセージをより表現力豊かにするのに役立ちます。
    |
    */

    'attributes' => [
        'tag' => 'タグ',
        'honorific_title_type' => '敬称',
        'current_password' => '現在のパスワード',
        'password' => 'パスワード',
        'phone' => '電話番号',
        'username' => '氏名',
        'status' => 'ステータス',
        'phone_number' => '電話番号',
        'description' => '説明文',
        'website' => 'ウェブサイト',
        'zip_code' => '郵便番号',
        'first_name' => '姓',
        'last_name' => '名',
        'birthday' => '生年月日',
        'address' => '住所',
        'gender' => '性別',
        'note' => '非アクティブされた理由',
        'avatar' => 'カバー追加',
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'price_per_hour' => '1時間の料金',
        'max_price_per_day' => '1日のMAX料金',
        'max_price_per_month' => '1ヶ月のMAX料金',
        'image_url' => '写真',
        'price' => '単価',
        'event_interests' => '興味のあるイベント',
        'experience' => '社会人経験年数',
        'desired_job' => '現在の転職意欲',
        'content' => 'コンテンツ',
        'token' => 'トークン',
        'image' => '写真',
        'title' => 'タイトル',
        'event_hack_category_id' => 'カテゴリー',
        'category_id' => 'カテゴリー',
        'result' => '結果',
        'result.*.question_id' => '結果',
        'result.*.question_type' => '質問タイプ',
        'answer' => '回答',
        'questions.*.answer' => '回答',
        'questions.*.correct_answer' => '回答',
        'question_options' => '回答',
        'question' => '質問',
        'questions.*.question' => '質問',
        'question_id' => '質問',
        'question_type' => '質問タイプ',
        'questions.*.question_type' => '質問タイプ',
        'user_answer' => '回答',
        'user_answer_text' => '記述式',
        'user_option_answer' => '回答',
        'post_code' => '郵便番号',
        'type' => 'タイプ',
        'subject' => 'お問い合わせ件名',
        'message' => 'お問い合わせ本文',
        'meet_url' => 'オンライン用URL',
        'professional_ids' => '顧客',
        'workshop_id' => 'ワークショップ',
        'video' => 'ビデオ',
        'video_type' => 'アップロード',
        'youtube_url' => 'Youtubeのリンク',
        'training_id' => 'トレーニング',
        'episode_id' => 'エピソード',
        'skill_id' => 'スキル',
        'goals' => '目標',
        'prefectures' => '都道府県',
        'published_at' => '出版時間',
        'thumb' => 'サムネイル',
        'date_expired' => '有効期限',
        'number_days_use' => '無料トライアル期間',
        'main_color' => 'サイト全体で使⽤しているカラー',
        'line_color' => '記事内で⾒出しや線の⾊として使われている',
        'background_color' => '記事内で⾒出しや背景⾊として使われている',
        'breadcrumb_text_color' => 'ぱんくずテキスト色',
        'domain_type' => 'ドメインの種類',
        'company_name' => '導入先事業者名',
        'company_name_kana' => 'クライアント名（カナ）',
        'prefecture_id' => '所在地 - 都道府県',
        'address_1' => '所在地 - 市区町村・番地',
        'address_2' => '所在地 - 建物名・階数など',
        'contract_note' => '契約条件',
        'operator_name' => '担当者 - 氏名',
        'operator_email' => '担当者 - メールアドレス',
        'operator_department' => '担当者 - 所属',
        'sub_domain' => 'サブドメイン',
        'full_domain' => '独自ドメイン',
        'terms_service_url' => '利用規約リンク',
        'ai_limit' => '仕様回数',
    ],
    'COM' => [
        '004' => ':attributeは既に存在します。',
        '005' => ':attributeは半角英数字で6桁〜20桁まで入力してください。',
        '006' => ':attributeが正しくありません。',
    ],
    'check_password_fail' => 'パスワードが正しくありません。',
    'email_fail' => 'このメールアドレスは登録されていません。',
    'invalid_plan' => '選択されたプランは無効です。',
];
