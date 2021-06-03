//ルーム接続機能を操作するためのクラスを変数に代入
const Peer = window.Peer;

//通話やチャットに必要な要素をHTMLから取得
(async function main() {
    const localVideo = document.getElementById('js-local-stream');
    const joinTrigger = document.getElementById('js-join-trigger');
    const leaveTrigger = document.getElementById('js-leave-trigger');
    const remoteVideos = document.getElementById('js-remote-streams');
    const roomId = document.getElementById('js-room-id');
    const localText = document.getElementById('js-local-text');
    const sendTrigger = document.getElementById('js-send-trigger');
    const messages = document.getElementById('js-messages');

    //ビデオの設定を許可
    const localStream = await navigator.mediaDevices
        .getUserMedia({
            audio: true,
            video: true,
        })
        .catch(console.error);

    // 自分のカメラの映像を表示
    localVideo.muted = true;
    localVideo.srcObject = localStream;
    localVideo.playsInline = true;
    await localVideo.play().catch(console.error);

    // 接続に必要なPeerインスタンスを作成
    const peer = (window.peer = new Peer({
        key: SKYWAY_KEY, //APIキー
        debug: 3,
    }));

    // Joinボタンを押すとイベント発火
    joinTrigger.addEventListener('click', () => {
        //サーバーへの接続ができない場合
        if (!peer.open) {
            return;
        }
        //サーバーへの接続ができる場合
        const room = peer.joinRoom(roomId.value, {
            mode: "mesh",
            stream: localStream,
        });
        //入室したらチャット欄に参加通知
        room.once('open', () => {
            messages.textContent += '=== You joined ===\n';
        });
        //ほかの人が同じルームに接続した場合にもチャット欄に参加通知
        room.on('peerJoin', peerId => {
            messages.textContent += `=== ${peerId} joined ===\n`;
        });

        //ほかの人が入室したらvideoタグを追加してカメラ表示
        room.on('stream', async stream => {
            const newVideo = document.createElement('video');
            newVideo.srcObject = stream;
            newVideo.playsInline = true;
            // 退室処理用に保存しとく
            newVideo.setAttribute('data-peer-id', stream.peerId);
            remoteVideos.append(newVideo);
            await newVideo.play().catch(console.error);
        });

        //同じルーム内にいる人同士でチャット
        room.on('data', ({ data, src }) => {
            messages.textContent += `${src}: ${data}\n`;
        });

        //退室したら画面を消す
        room.on('peerLeave', peerId => {
            const remoteVideo = remoteVideos.querySelector(
                `[data-peer-id="${peerId}"]`
            );
            remoteVideo.srcObject.getTracks().forEach(track => track.stop());
            remoteVideo.srcObject = null;
            remoteVideo.remove();
            //ほかの人が退室したらチャット欄に退室メッセージ
            messages.textContent += `=== ${peerId} left ===\n`;
        });

        //自分の退室処理
        room.once('close', () => {
            sendTrigger.removeEventListener('click', onClickSend);
            messages.textContent += '== You left ===\n';
            Array.from(remoteVideos.children).forEach(remoteVideo => {
                remoteVideo.srcObject.getTracks().forEach(track => track.stop());
                remoteVideo.srcObject = null;
                remoteVideo.remove();
            });
        });

        sendTrigger.addEventListener('click', onClickSend);
        leaveTrigger.addEventListener('click', () => room.close(), { once: true });

        function onClickSend() {
            // メッセージを送る
            room.send(localText.value);

            messages.textContent += `${peer.id}: ${localText.value}\n`;
            localText.value = '';
        }
    });

    peer.on('error', console.error);
})();