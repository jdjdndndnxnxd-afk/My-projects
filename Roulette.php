<?php

define('BOT_TOKEN', 'توكن');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
define('USERS_FILE', 'users.json');
define('ROULETTES_FILE', 'roulettes.json');
define('BOUND_CHANNELS_FILE', 'bound_channels.json');
define('BANNED_USERS_FILE', 'banned_users.json');
if (!file_exists(USERS_FILE)) file_put_contents(USERS_FILE, '{}');
if (!file_exists(ROULETTES_FILE)) file_put_contents(ROULETTES_FILE, '{}');
if (!file_exists(BOUND_CHANNELS_FILE)) file_put_contents(BOUND_CHANNELS_FILE, '{}');
if (!file_exists(BANNED_USERS_FILE)) file_put_contents(BANNED_USERS_FILE, '{}');
$texts = [
'start' => "👋 أهلاً بك في بوت الروليت!
اضغط الزر أدناه لإنشاء روليت:",
'channel_binding' => "1️⃣ أضف البوت كمشرف في قناتك.
2️⃣ قم بإعادة توجيه أي رسالة من قناتك إلى البوت 

📌 ملاحظة:
جميع المشرفين الآخرين في القناة سيتمكنون أيضًا من استخدام البوت بعد إضافته.",
'roulette_text_prompt' => "أرسل كليشة السحب

1 - للتشويش: 
مثال

2 - للتعريض: 
مثال

3 - لجعل النص مائل: 
مثال

4 - للاقتباس: 
مثال

🚫 رجاءً عدم إرسال روابط نهائياً",
'conditional_channel_question' => "هل تريد إضافة قناة شرط؟

عند إضافة قناة شرط لن يتمكن أحد من المشاركة في السحب قبل الانضمام لقناة الشرط.",
'send_conditional_link' => "أرسل رابط القناة الشرطية (مثال: @amrakl / https://t.me/amrakl)",
'not_your_command' => "❗ هذا الأمر مخصص لمنشئ الروليت فقط.",
'channel_bound' => "✅ تم ربط القناة: @%s",
'roulette_created' => "✅ تم نشر الروليت في القناة: @%s

تحكم بالروليت الخاص بك من خلال رسالة السحب في القناة (ID: %s).",
'roulette_published' => "🎉 تم إنشاء الروليت بنجاح ونشره!",
'invalid_command' => "❗ أمر غير مفهوم. الرجاء استخدام الأزرار أو /start للبدء.",
'channel_not_found' => "❗ لم أتمكن من العثور على هذه القناة. تأكد من صحة الرابط وأن البوت مشرف فيها.",
'invalid_link' => "❗ الرابط غير صالح. الرجاء إرسال رابط قناة صحيح (مثال: @amrakl أو https://t.me/amrakl).",
'not_channel' => "❗ هذا ليس رابط قناة. الرجاء إرسال رابط قناة.",
'invalid_winners' => "❗ الرجاء إرسال عدد صحيح موجب للفائزين.",
'missing_data' => "❗ حدث خطأ: بيانات الروليت غير مكتملة. يرجى البدء من جديد عبر /start.",
'channel_not_admin' => "❗ البوت ليس مشرفاً في هذه القناة. الرجاء إضافة البوت كمشرف وإعادة التوجيه.",
'channel_error' => "❗ حدث خطأ أثناء التحقق من صلاحيات البوت في القناة. تأكد من أن القناة عامة وأن البوت مشرف.",
'forward_message' => "❗ يرجى إعادة توجيه رسالة من قناة عامة أضفت فيها البوت كمشرف.",
'text_saved' => "✅ تم حفظ الكليشة، اختر أحد الخيارات:",
'text_updated' => "✅ تم تحديث الكليشة، اختر أحد الخيارات:",
'channel_saved' => "✅ تم حفظ القناة الشرطية: @%s",
'enter_winners' => "📝 كم عدد الفائزين الذين تريد اختيارهم؟",
'disconnected' => "✖️ تم فصل القناة بنجاح.",
'not_bound' => "❗ لم يتم تعيين قناة لك مسبقاً.",
'no_text' => "❗ الرجاء إدخال كليشة السحب أولاً.",
'joined' => "✅ تم تسجيل مشاركتك!",
'already_joined' => "✅ أنت مشارك بالفعل.",
'stopped' => "⛔ المشاركة في هذا السحب متوقفة حالياً.",
'creator_join' => "لا يمكنك المشاركة في سحبك الخاص.",
'banned' => "🚫 تم استبعادك من سحوبات هذا المنشئ.",
'subscribe_first' => "📛 عليك الاشتراك في القناة الشرطية أولاً للمشاركة.",
'subscribe_error' => "⚠️ خطأ في التحقق من الاشتراك في القناة الشرطية.",
'new_participant' => "🎉 مشاركة جديدة في سحبك:

👤 %s
🆔 %d
📊 عدد المشاركين الكلي: %d",
'participation_on' => "✅ تم تشغيل المشاركة.",
'participation_off' => "⛔ تم إيقاف المشاركة.",
'no_participants' => "❗ لا يوجد مشاركون في السحب.",
'already_drawn' => "❗ تم السحب مسبقاً لهذا الروليت.",
'draw_complete' => "✅ تم سحب الفائزين بنجاح!",
'winner_notification' => "🎉 تهانينا! لقد فزت في السحب:

%s

🏆 يمكنك التحقق من الفائزين في القناة: @%s",
'participant_excluded' => "✅ تم استبعاد المستخدم %d من هذا السحب وسحوباتك المستقبلية.",
'not_in_roulette' => "❗ هذا المشارك ليس في السحب أو تم استبعاده مسبقاً.",
'reminder_set' => "🔔 سيتم إشعارك إذا فزت في هذا السحب!",
'reminder_info' => "للتذكير، يجب عليك تفعيل زر التذكير لكل سحب على حدة في رسالة السحب. هذا الزر يعرض معلومات فقط.",
'no_participants_list' => "لا يوجد مشاركون حالياً في هذا السحب.",
'participants_list' => "قائمة المشاركين:\n%s"
];
function apiRequest($method, $params = []) {
$url = API_URL . $method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($ch);
curl_close($ch);
return json_decode($response, true);
}
function buildKeyboard($buttons, $inline = false) {
$keyboard = ['inline_keyboard' => []];
foreach ($buttons as $row) {
$keyboardRow = [];
foreach ($row as $button) {
$keyboardRow[] = [
'text' => $button['text'],
'callback_data' => $button['callback']
];
}
$keyboard['inline_keyboard'][] = $keyboardRow;
}
return $inline ? json_encode($keyboard) : json_encode(['keyboard' => $keyboard, 'resize_keyboard' => true]);
}
// مبرمج الملف ناميرو لا تنسي الحقوق ممنوع تغييرها @S_P_P1
# قناه المبرمج @NameroBots
function mainMenuKeyboard() {
global $texts;
return [
[['text' => '🎯 إنشاء روليت', 'callback' => 'create_roulette']],
[['text' => '🔗 ربط قناة', 'callback' => 'bind_main_channel'],['text' => '✖️ فصل القناة', 'callback' => 'disconnect_main_channel']],[['text' => '🔔 ذكرني إذا فزت', 'callback' => 'remind_me_global_info']]
];
}
function channelBindingKeyboard() {
global $texts;
return [
[['text' => '📥 أضفني إلى قناتك', 'callback' => 'add_to_channel'],['text' => '🔙 رجوع', 'callback' => 'back_to_main_menu']]
];
}
function rouletteOptionsKeyboard() {
global $texts;
return [
[['text' => '🎨 تعديل الكليشة', 'callback' => 'choose_style_instructions']],
[['text' => '➕ إضافة قناة شرط', 'callback' => 'prompt_conditional_channel'],['text' => '⏭️ تخطي', 'callback' => 'skip_conditional_channel']]
];
}
function conditionalChannelKeyboard() {
global $texts;
return [
[['text' => '🔗 إضافة رابط قناة', 'callback' => 'send_conditional_channel_link_prompt'],
['text' => '⏭️ تخطي', 'callback' => 'skip_conditional_channel']]
];
}
function rouletteChannelKeyboard($rouletteId, $isActive) {
global $texts;
return [
[['text' => '🎁 المشاركة في السحب', 'callback' => 'join_roulette_'.$rouletteId]],[['text' => '🔔 ذكرني إذا فزت', 'callback' => 'remind_me_roulette_'.$rouletteId]],
[['text' => ($isActive ? '⏸️ إيقاف المشاركة' : '▶️ تشغيل المشاركة'), 'callback' => 'toggle_participation_'.$rouletteId],['text' => '🏁 ابدأ السحب', 'callback' => 'start_draw_'.$rouletteId]],
[['text' => '📊 عرض المشاركين', 'callback' => 'view_participants_'.$rouletteId]]
];
}
function excludeParticipantKeyboard($rouletteId, $participantId) {
global $texts;
return [
[['text' => '❌ استبعاد هذا المشارك', 'callback' => 'exclude_participant_'.$rouletteId.'_'.$participantId]]
];
}
function readData($file) {
return json_decode(file_get_contents($file), true);
}
function saveData($file, $data) {
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}
function updateRouletteMessage($rouletteId) {
$roulettes = readData(ROULETTES_FILE);
if (!isset($roulettes[$rouletteId])) return;
$r = $roulettes[$rouletteId];
$participantsCount = count($r['participants']);
$updatedText = $r['text'] . "

👥 عدد المشاركين: " . $participantsCount;
if (!$r['active']) {
$updatedText .= "
⛔ المشاركة متوقفة حالياً.";
}
if (!empty($r['winners'])) {
$winnersUsernames = [];
foreach ($r['winners'] as $winner_id) {
$winnersUsernames[] = "المستخدم " . $winner_id;
}
$updatedText .= "

🏆 الفائزون:
" . implode("
", $winnersUsernames);
}
apiRequest('editMessageText', [
'chat_id' => $r['main_channel_id'],
'message_id' => $r['channel_message_id'],
'text' => $updatedText,
'parse_mode' => 'HTML',
'reply_markup' => buildKeyboard(rouletteChannelKeyboard($rouletteId, $r['active']), true)
]);
}
function publishRoulette($userId) {
global $texts;
$userTempData = readData('temp_'.$userId.'.json');
if (!$userTempData || !isset($userTempData['roulette_text']) || !isset($userTempData['main_channel_id']) || !isset($userTempData['winners_count'])) {
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['missing_data']
]);
return;
}
$rouletteId = uniqid();
$initialText = $userTempData['roulette_text'] . "

👥 عدد المشاركين: 0";
$response = apiRequest('sendMessage', [
'chat_id' => $userTempData['main_channel_id'],
'text' => $initialText,
'parse_mode' => 'HTML',
'reply_markup' => buildKeyboard(rouletteChannelKeyboard($rouletteId, true), true)
]);
if (!$response || !$response['ok']) {
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => "❗ فشل في النشر داخل القناة. تأكد أن البوت مشرف ولديه صلاحية إرسال الرسائل."
]);
return;
}
$roulettes = readData(ROULETTES_FILE);
$roulettes[$rouletteId] = [
'creator_id' => $userId,
'main_channel_id' => $userTempData['main_channel_id'],
'main_channel_username' => $userTempData['main_channel_username'],
'channel_message_id' => $response['result']['message_id'],
'text' => $userTempData['roulette_text'],
'conditional_channel_id' => $userTempData['conditional_channel_id'] ?? null,
'conditional_channel_username' => $userTempData['conditional_channel_username'] ?? null,
'winners_count' => $userTempData['winners_count'],
'participants' => [],
'active' => true,
'winners' => [],
'reminders' => []
];
saveData(ROULETTES_FILE, $roulettes);
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => sprintf($texts['roulette_created'], $userTempData['main_channel_username'], $rouletteId)
]);
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['roulette_published']
]);
if (file_exists('temp_'.$userId.'.json')) {
unlink('temp_'.$userId.'.json');
}
}
// مبرمج الملف ناميرو لا تنسي الحقوق ممنوع تغييرها @S_P_P1
# قناه المبرمج @NameroBots
function processMessage($update) {
global $texts;
$message = $update['message'];
$userId = $message['from']['id'];
$chatId = $message['chat']['id'];
$text = $message['text'] ?? '';
if (strpos($text, '/start') === 0) {
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['start'],
'reply_markup' => buildKeyboard(mainMenuKeyboard(), true)
]);
return;
}
$userStates = readData(USERS_FILE);
$currentState = $userStates[$userId]['state'] ?? '';
switch ($currentState) {
case 'awaiting_main_channel_forward':
if (isset($message['forward_from_chat']) && $message['forward_from_chat']['type'] == 'channel') {
$channel = $message['forward_from_chat'];
$response = apiRequest('getChatMember', [
'chat_id' => $channel['id'],
'user_id' => explode(':', BOT_TOKEN)[0]
]);
if (!$response['ok'] || !in_array($response['result']['status'], ['administrator', 'creator'])) {
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['channel_not_admin']
]);
return;
}
$boundChannels = readData(BOUND_CHANNELS_FILE);
$boundChannels[$userId] = [
'channel_id' => $channel['id'],
'channel_username' => $channel['username'] ?? $channel['title']
];
saveData(BOUND_CHANNELS_FILE, $boundChannels);
unset($userStates[$userId]['state']);
saveData(USERS_FILE, $userStates);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => sprintf($texts['channel_bound'], $channel['username'] ?? $channel['title'])
]);
} else {
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['forward_message']
]);
}
break;
case 'awaiting_roulette_text':
$userTempData = [
'main_channel_id' => $userStates[$userId]['main_channel_id'],
'main_channel_username' => $userStates[$userId]['main_channel_username'],
'roulette_text' => $text
];
file_put_contents('temp_'.$userId.'.json', json_encode($userTempData));
unset($userStates[$userId]['state']);
$userStates[$userId]['state'] = 'awaiting_roulette_options_choice';
saveData(USERS_FILE, $userStates);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['text_saved'],
'reply_markup' => buildKeyboard(rouletteOptionsKeyboard(), true)
]);
break;
case 'awaiting_conditional_channel_link':
$channelLink = trim($text);
$channelId = null;
$channelUsername = null;
if (preg_match('/^(?:https?:\/\/t\.me\/)?@?([a-zA-Z0-9_]+)$/', $channelLink, $matches)) {
$channelUsername = '@'.$matches[1];
try {
$response = apiRequest('getChat', ['chat_id' => $channelUsername]);
if ($response['ok'] && $response['result']['type'] == 'channel') {
$channelId = $response['result']['id'];
$channelUsername = $response['result']['username'] ?? $channelUsername;
} else {
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['not_channel']
]);
return;
}
} catch (Exception $e) {
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['channel_not_found']
]);
return;
}
} else {
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['invalid_link']
]);
return;
}

$userTempData = json_decode(file_get_contents('temp_'.$userId.'.json'), true);
$userTempData['conditional_channel_id'] = $channelId;
$userTempData['conditional_channel_username'] = $channelUsername;
file_put_contents('temp_'.$userId.'.json', json_encode($userTempData));
unset($userStates[$userId]['state']);
$userStates[$userId]['state'] = 'awaiting_winner_count';
saveData(USERS_FILE, $userStates);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => sprintf($texts['channel_saved'], $channelUsername)
]);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['enter_winners']
]);
break;
case 'awaiting_winner_count':
if (is_numeric($text) && $text > 0) {
$userTempData = json_decode(file_get_contents('temp_'.$userId.'.json'), true);
$userTempData['winners_count'] = (int)$text;
file_put_contents('temp_'.$userId.'.json', json_encode($userTempData));
unset($userStates[$userId]['state']);
saveData(USERS_FILE, $userStates);
publishRoulette($userId);
} else {
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['invalid_winners']
]);
}
// مبرمج الملف ناميرو لا تنسي الحقوق ممنوع تغييرها @S_P_P1
# قناه المبرمج @NameroBots
break;
default:
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['invalid_command'],
'reply_markup' => buildKeyboard(mainMenuKeyboard(), true)
]);
}
}
function processCallbackQuery($update) {
global $texts;
$callback = $update['callback_query'];
$userId = $callback['from']['id'];
$messageId = $callback['message']['message_id'];
$chatId = $callback['message']['chat']['id'];
$data = $callback['data'];
$callback_query_id = $update->callback_query->id;

apiRequest('answerCallbackQuery', ['callback_query_id' => $callback['id']]);
$userStates = readData(USERS_FILE);
$roulettes = readData(ROULETTES_FILE);
$boundChannels = readData(BOUND_CHANNELS_FILE);
$bannedUsers = readData(BANNED_USERS_FILE);

if ($data == 'back_to_main_menu') {
unset($userStates[$userId]['state']);
saveData(USERS_FILE, $userStates);
apiRequest('editMessageText', [
'chat_id' => $chatId,
'message_id' => $messageId,
'text' => $texts['start'],
'reply_markup' => buildKeyboard(mainMenuKeyboard(), true)
]);
}
elseif ($data == 'create_roulette') {
if (!isset($boundChannels[$userId])) {
apiRequest('editMessageText', [
'chat_id' => $chatId,
'message_id' => $messageId,
'text' => "❗ عليك ربط قناة أولاً قبل إنشاء الروليت.",
'reply_markup' => buildKeyboard(channelBindingKeyboard(), true)
]);
$userStates[$userId]['state'] = 'awaiting_main_channel_forward';
saveData(USERS_FILE, $userStates);
return;
}

$userStates[$userId]['state'] = 'awaiting_roulette_text';
$userStates[$userId]['main_channel_id'] = $boundChannels[$userId]['channel_id'];
$userStates[$userId]['main_channel_username'] = $boundChannels[$userId]['channel_username'];
saveData(USERS_FILE, $userStates);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['roulette_text_prompt'],
'parse_mode' => 'HTML'
]);
}
elseif ($data == 'bind_main_channel') {
$userStates[$userId]['state'] = 'awaiting_main_channel_forward';
saveData(USERS_FILE, $userStates);
apiRequest('editMessageText', [
'chat_id' => $chatId,
'message_id' => $messageId,
'text' => $texts['channel_binding'],
'reply_markup' => buildKeyboard(channelBindingKeyboard(), true)
]);
}
elseif ($data == 'disconnect_main_channel') {
if (isset($boundChannels[$userId])) {
unset($boundChannels[$userId]);
saveData(BOUND_CHANNELS_FILE, $boundChannels);
$message = $texts['disconnected'];
} else {
$message = $texts['not_bound'];
}
// مبرمج الملف ناميرو لا تنسي الحقوق ممنوع تغييرها @S_P_P1
apiRequest('editMessageText', [
'chat_id' => $chatId,
'message_id' => $messageId,
'text' => $message,
'reply_markup' => buildKeyboard(mainMenuKeyboard(), true)
]);
}
elseif ($data == 'choose_style_instructions') {
if ($userStates[$userId]['state'] != 'awaiting_roulette_options_choice') {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['no_text'],
'show_alert' => true
]);
return;
}

$userStates[$userId]['state'] = 'awaiting_roulette_text_edit';
saveData(USERS_FILE, $userStates);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['roulette_text_prompt'],
'parse_mode' => 'HTML'
]);
}
elseif ($data == 'prompt_conditional_channel') {
if (!file_exists('temp_'.$userId.'.json') || !json_decode(file_get_contents('temp_'.$userId.'.json'), true)['roulette_text']) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['no_text'],
'show_alert' => true
]);
return;
}

$userStates[$userId]['state'] = 'awaiting_conditional_channel_choice';
saveData(USERS_FILE, $userStates);
apiRequest('editMessageText', [
'chat_id' => $chatId,
'message_id' => $messageId,
'text' => $texts['conditional_channel_question'],
'reply_markup' => buildKeyboard(conditionalChannelKeyboard(), true)
]);
}
elseif ($data == 'send_conditional_channel_link_prompt') {
$userStates[$userId]['state'] = 'awaiting_conditional_channel_link';
saveData(USERS_FILE, $userStates);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['send_conditional_link']
]);
}
// مبرمج الملف ناميرو لا تنسي الحقوق ممنوع تغييرها @S_P_P1
# قناه المبرمج @NameroBots
elseif ($data == 'skip_conditional_channel') {
$userTempData = json_decode(file_get_contents('temp_'.$userId.'.json'), true);
$userTempData['conditional_channel_id'] = null;
$userTempData['conditional_channel_username'] = null;
file_put_contents('temp_'.$userId.'.json', json_encode($userTempData));
$userStates[$userId]['state'] = 'awaiting_winner_count';
saveData(USERS_FILE, $userStates);
apiRequest('sendMessage', [
'chat_id' => $chatId,
'text' => $texts['enter_winners']
]);
}
elseif (strpos($data, 'join_roulette_') === 0) {
$rouletteId = substr($data, strlen('join_roulette_'));
if (!isset($roulettes[$rouletteId])) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => "❗ السحب غير موجود.",
'show_alert' => true
]);
return;
}

$r = $roulettes[$rouletteId];

if ($userId == $r['creator_id']) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['creator_join'],
'show_alert' => true
]);
return;
}

if (!$r['active']) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['stopped'],
'show_alert' => true
]);
return;
}
if (in_array($userId, $r['participants'])) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['already_joined'],
'show_alert' => true
]);
return;
}
if (isset($bannedUsers[$r['creator_id']]) && in_array($userId, $bannedUsers[$r['creator_id']])) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['banned'],
'show_alert' => true
]);
return;
}
if ($r['conditional_channel_id']) {
$response = apiRequest('getChatMember', [
'chat_id' => $r['conditional_channel_id'],
'user_id' => $userId
]);
if (!$response['ok'] || in_array($response['result']['status'], ['left', 'kicked'])) {
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => "📛 للمشاركة في السحب، اشترك أولًا في القناة الشرطية:

🔗 https://t.me/{$r['conditional_channel_username']}"
]);
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => "يرجى الاشتراك أولاً في القناة الشرطية.",
'show_alert' => true
]);
return;
}
}
$mainChannelCheck = apiRequest('getChatMember', [
'chat_id' => $r['main_channel_id'],
'user_id' => $userId
]);
if (!$mainChannelCheck['ok'] || in_array($mainChannelCheck['result']['status'], ['left', 'kicked'])) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => "📛 يجب عليك الاشتراك في القناة أولاً للمشاركة في السحب.",
'show_alert' => true
]);
return;
}
$roulettes[$rouletteId]['participants'][] = $userId;
saveData(ROULETTES_FILE, $roulettes);
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['joined']
]);
updateRouletteMessage($rouletteId);
$username = $callback['from']['username'] ? '@'.$callback['from']['username'] : 'المستخدم '.$userId;
apiRequest('sendMessage', [
'chat_id' => $r['creator_id'],
'text' => sprintf($texts['new_participant'], $username, $userId, count($roulettes[$rouletteId]['participants'])),
'reply_markup' => buildKeyboard(excludeParticipantKeyboard($rouletteId, $userId), true)
]);
}
elseif (strpos($data, 'toggle_participation_') === 0) {
$rouletteId = substr($data, strlen('toggle_participation_'));
if (!isset($roulettes[$rouletteId]) || $userId != $roulettes[$rouletteId]['creator_id']) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['not_your_command'],
'show_alert' => true
]);
return;
}
$roulettes[$rouletteId]['active'] = !$roulettes[$rouletteId]['active'];
saveData(ROULETTES_FILE, $roulettes);
$statusText = $roulettes[$rouletteId]['active'] ? $texts['participation_on'] : $texts['participation_off'];
updateRouletteMessage($rouletteId);
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $statusText
]);
}
elseif (strpos($data, 'start_draw_') === 0) {
$rouletteId = substr($data, strlen('start_draw_'));
if (!isset($roulettes[$rouletteId]) || $userId != $roulettes[$rouletteId]['creator_id']) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['not_your_command'],
'show_alert' => true
]);
return;
}

if (empty($roulettes[$rouletteId]['participants'])) {
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['no_participants']
]);
return;
}

if (!empty($roulettes[$rouletteId]['winners'])) {
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['already_drawn']
]);
return;
}
$winnersCount = min($roulettes[$rouletteId]['winners_count'], count($roulettes[$rouletteId]['participants']));
$winners = array_rand(array_flip($roulettes[$rouletteId]['participants']), $winnersCount);
$roulettes[$rouletteId]['winners'] = is_array($winners) ? $winners : [$winners];
$roulettes[$rouletteId]['active'] = false;
saveData(ROULETTES_FILE, $roulettes);
updateRouletteMessage($rouletteId);
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['draw_complete']
]);
foreach ($roulettes[$rouletteId]['winners'] as $winnerId) {
if (in_array($winnerId, $roulettes[$rouletteId]['reminders'])) {
apiRequest('sendMessage', [
'chat_id' => $winnerId,
'text' => sprintf($texts['winner_notification'], $roulettes[$rouletteId]['text'], $roulettes[$rouletteId]['main_channel_username']),
'parse_mode' => 'HTML'
]);
}
}
}
elseif (strpos($data, 'exclude_participant_') === 0) {
$parts = explode('_', $data);
$rouletteId = $parts[2];
$participantId = (int)$parts[3];
if (!isset($roulettes[$rouletteId]) || $userId != $roulettes[$rouletteId]['creator_id']) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['not_your_command'],
'show_alert' => true
]);
return;
}
if (($key = array_search($participantId, $roulettes[$rouletteId]['participants'])) !== false) {
unset($roulettes[$rouletteId]['participants'][$key]);
$bannedUsers[$userId][] = $participantId;
$bannedUsers[$userId] = array_unique($bannedUsers[$userId]);
saveData(BANNED_USERS_FILE, $bannedUsers);
saveData(ROULETTES_FILE, $roulettes);
updateRouletteMessage($rouletteId);
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => "✅ تم استبعاد المستخدم [$participantId](tg://user?id=$participantId) من السحب.",
'parse_mode' => 'Markdown'
]);
apiRequest('sendMessage', [
'chat_id' => $participantId,
'text' => "🚫 تم استبعادك من هذا السحب بواسطة الإدارة."
]);
apiRequest('editMessageText', [
'chat_id' => $chatId,
'message_id' => $messageId,
'text' => sprintf($texts['participant_excluded'], $participantId)
]);
} else {
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['not_in_roulette']
]);
}
}
elseif (strpos($data, 'remind_me_roulette_') === 0) {
$rouletteId = substr($data, strlen('remind_me_roulette_'));
if (!isset($roulettes[$rouletteId])) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => "❗ السحب غير موجود.",
'show_alert' => true
]);
return;
}
$roulettes[$rouletteId]['reminders'][] = $userId;
saveData(ROULETTES_FILE, $roulettes);
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['reminder_set']
]);
}
elseif ($data == 'remind_me_global_info') {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['reminder_info'],
'show_alert' => true
]);
}
elseif (strpos($data, 'view_participants_') === 0) {
$rouletteId = substr($data, strlen('view_participants_'));
if (!isset($roulettes[$rouletteId]) || $userId != $roulettes[$rouletteId]['creator_id']) {
apiRequest('answerCallbackQuery', [
'callback_query_id' => $callback['id'],
'text' => $texts['not_your_command'],
'show_alert' => true
]);
return;
}
if (empty($roulettes[$rouletteId]['participants'])) {
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => $texts['no_participants_list']
]);
return;
}
$participantsList = [];
foreach ($roulettes[$rouletteId]['participants'] as $pId) {
$participantsList[] = "👤 المستخدم (ID: $pId)";
}
apiRequest('sendMessage', [
'chat_id' => $userId,
'text' => sprintf($texts['participants_list'], implode("\n", $participantsList))
]);
}
}
$update = json_decode(file_get_contents('php://input'), true);
if (isset($update['message'])) {
processMessage($update);
} elseif (isset($update['callback_query'])) {
processCallbackQuery($update);
}
