import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:webview_flutter/webview_flutter.dart';
import 'package:flutter_icons/flutter_icons.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:flutter/services.dart';
import 'dart:async';
import 'scanner.dart';
import 'qrscanner.dart';




void main() => runApp(MyApp());
class MyApp extends StatelessWidget {
  @override
  const MyApp({Key? key}) : super(key: key);
  Widget build(BuildContext context){
    return new MaterialApp(
        debugShowCheckedModeBanner: false,
        home: new MySApp()

    );
  }
}



class MySApp extends StatefulWidget {
  @override
  _MySApp createState() => _MySApp();
}
//
class _MySApp extends State<MySApp> {
//   String _scanBarcode = 'Unknown';
//
//   @override
//   void initState() {
//     super.initState();
//   }
//
//   Future<void> startBarcodeScanStream() async {
//     FlutterBarcodeScanner.getBarcodeStreamReceiver(
//         '#ff6666', 'Cancel', true, ScanMode.BARCODE)!
//         .listen((barcode) => print(barcode));
//   }
//
//   Future<void> scanQR() async {
//     String barcodeScanRes;
//     try {
//       barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
//           '#ff6666', 'Cancel', true, ScanMode.QR);
//       print(barcodeScanRes);
//     } on PlatformException {
//       barcodeScanRes = 'Failed to get platform version.';
//     }
// //barcode scanner flutter ant
//     setState(() {
//       _scanBarcode = barcodeScanRes;
//     });
//   }
//
//   Future<void> scanBarcodeNormal() async {
//     String barcodeScanRes;
//     try {
//       barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
//           '#ff6666', 'Cancel', true, ScanMode.BARCODE);
//       print(barcodeScanRes);
//
//     } on PlatformException {
//       barcodeScanRes = 'Failed to get platform version.';
//     }
//
//     if (!mounted) return;
//     setState(() {
//       _scanBarcode = barcodeScanRes;
//       print(_scanBarcode);
//     });
//     void main1() => runApp(MyApp());
//
//   }
//barcode scanner flutter ant
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,

      title: 'SILDMS',


      home: Scaffold(
        appBar: AppBar(
          actions: [Padding(
            padding: EdgeInsets.only(right: 0),
            child: IconButton(
              icon: Icon(
                AntDesign.barcode,
                color: Colors.black,
              ),
              onPressed: () {
                  Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => Scanner()),
                );
              },
            ),
          ),
            // Padding(
            //   padding: EdgeInsets.only(right: 0),
            //   child: IconButton(
            //     icon: Icon(
            //       Icons.qr_code_scanner_rounded,
            //       color: Colors.black,
            //     ),
            //     onPressed: () {
            //       Navigator.push(
            //         context,
            //         MaterialPageRoute(builder: (context) => QrScanner()),
            //       );
            //     },
            //   ),
            // ),


          ],
          title: Text(
            'SILDMS',
            style: TextStyle(
              color: Colors.black,
              fontFamily: 'Montserrat',
              fontSize: 28.0,
              fontWeight: FontWeight.bold,
            ),),


          backgroundColor: Colors.orange,
        ),
        body:
        WebView(
          initialUrl: "https://sildms.devomkar.com",
          javascriptMode: JavascriptMode.unrestricted,
        ),
      ),

    );
  }
}


