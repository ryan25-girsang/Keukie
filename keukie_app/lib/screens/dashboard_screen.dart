import 'package:flutter/material.dart';

class DashboardScreen extends StatelessWidget {
  const DashboardScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF0a0a0a),
      body: const Center(
        child: Text(
          'Dahsboard',
          style: TextStyle(color: Color(0xFF00ffcc), fontSize: 24),
        ),
      ),
    );
  }
}