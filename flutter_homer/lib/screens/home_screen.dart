import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Sanctuaire Explorer'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Bienvenue sur Sanctuaire Explorer !',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 12),
            const Text(
              "Partez à la découverte des plus beaux sanctuaires japonais en France. Explorez, partagez vos découvertes, et enrichissez la communauté.",
              style: TextStyle(fontSize: 16),
            ),
            const SizedBox(height: 24),

            // Lien vers la liste des sanctuaires
            ElevatedButton(
              onPressed: () {
                context.go('/sanctuaires');
              },
              child: const Text("Voir les sanctuaires"),
            ),

            const SizedBox(height: 12),

            // Lien vers la connexion / inscription
            ElevatedButton(
              onPressed: () {
                context.go('/login');
              },
              child: const Text("Se connecter / S'inscrire"),
            ),
          ],
        ),
      ),
    );
  }
}
