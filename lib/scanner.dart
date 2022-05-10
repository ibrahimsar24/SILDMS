import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:flutter_icons/flutter_icons.dart';
import 'package:sildms/qrscanner.dart';
import 'package:webview_flutter/webview_flutter.dart';


void main() => runApp(Scanner());

class Scanner extends StatefulWidget {
  @override
  _Scanner createState() => _Scanner();
}

class _Scanner extends State<Scanner> {
  String _scanBarcode = 'Unknown';

  @override
  void initState() {
    super.initState();
  }

  Future<void> startBarcodeScanStream() async {
    FlutterBarcodeScanner.getBarcodeStreamReceiver(
        '#ff6666', 'Cancel', true, ScanMode.BARCODE)!
        .listen((barcode) => print(barcode));
  }

  Future<void> scanQR() async {
    String barcodeScanRes;
    try {
      barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
          '#00FF00', 'Cancel', true, ScanMode.QR);
      print(barcodeScanRes);
    } on PlatformException {
      barcodeScanRes = 'Failed to get platform version.';
    }
//barcode scanner flutter ant
    setState(() {
      _scanBarcode = barcodeScanRes;
    });
  }

  Future<void> scanBarcodeNormal() async {
    String barcodeScanRes;
    try {
      barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
          '#ff6666', 'Cancel', true, ScanMode.BARCODE);
      print(barcodeScanRes);
    } on PlatformException {
      barcodeScanRes = 'Failed to get platform version.';
    }

    if (!mounted) return;
    setState(() {
      _scanBarcode = barcodeScanRes;
    });
  }

//barcode scanner flutter ant
  @override
  Widget build(BuildContext context) {
    // scanBarcodeNormal();
    print(_scanBarcode);
    if (_scanBarcode == 'Unknown') {
      scanBarcodeNormal();
      return MaterialApp(
          debugShowCheckedModeBanner: false,
          home: Scaffold(
              appBar: AppBar(centerTitle: true,
                  backgroundColor: Colors.orange,
                  title: Text(
                      'Scanner',
                      style: TextStyle(
                        color: Colors.black,
                        fontFamily: 'Montserrat',
                        fontSize: 28.0,
                        fontWeight: FontWeight.bold,
                      )),
                  leading: IconButton(onPressed: () {},
                      icon: const Icon(Icons.arrow_back, color: Colors.black,))

              ),
              body: Builder(builder: (BuildContext context) {
                return Container(
                    alignment: Alignment.center,
                    // child: Flex(
                    //     direction: Axis.vertical,
                    //     mainAxisAlignment: MainAxisAlignment.center,
                    //     children: <Widget>[
                    //       ElevatedButton(
                    //           onPressed: () => scanBarcodeNormal(),
                    //           child: const Text('Barcode scan')),
                    //       ElevatedButton(
                    //           onPressed: () => scanQR(),
                    //           child: const Text('QR scan')),
                    //       Text('Scan result : $_scanBarcode\n',
                    //           style: const TextStyle(fontSize: 20))
                    //     ]
                    // )
                );
              }
              )
          )
      );
    } else {
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
            initialUrl: "https://sildms.devomkar.com/user/profile/"+_scanBarcode,
            javascriptMode: JavascriptMode.unrestricted,
          ),
        ),

      );
    }
  }
}